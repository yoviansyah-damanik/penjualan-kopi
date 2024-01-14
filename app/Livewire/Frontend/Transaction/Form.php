<?php

namespace App\Livewire\Frontend\Transaction;

use Exception;
use Throwable;
use Carbon\Carbon;
use App\Models\Cart;
use Livewire\Component;
use App\Models\Shipping;
use App\Models\Transaction;
use App\Helpers\OngkirHelper;
use Livewire\Attributes\Rule;
use App\Models\DetailTransaction;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Illuminate\Validation\Rule as ValidationRule;

class Form extends Component
{
    use LivewireAlert;
    #[Rule('required|string|min:3|max:200')]
    public $orderer_name;

    #[Rule('required|string|min:3')]
    public $address;

    #[Rule('nullable|string|max:200')]
    public $note;

    #[Rule('required|numeric|digits_between:11,13')]
    public $phone_number;

    public $carts;
    public $provinces;
    public $province = 0;
    public $cities;
    public $city = 0;
    public $button_enable = true;

    #[Rule('required|numeric|min:0')]
    public $shipping_cost = 0;

    #[Rule('required|numeric|min:0')]
    public $estimation_day = 0;

    public function mount($carts)
    {
        $this->carts = $carts;
        $this->set_provinces();
    }

    public function render()
    {
        return view('livewire.frontend.transaction.form');
    }

    public function rules()
    {
        return [
            'province' => [
                'required',
                ValidationRule::in(collect($this->provinces)->pluck('province_id')->toArray())
            ],
            'city' => [
                'required',
                ValidationRule::in(collect($this->cities)->pluck('city_id')->toArray())
            ]
        ];
    }

    public function validationAttributes()
    {
        return [
            'orderer_name' => __('Orderer Name'),
            'address' => __('Address'),
            'province' => __('Province'),
            'phone_number' => __('Phone Number'),
            'city' => __('City'),
            'note' => __('Note')
        ];
    }

    public function set_provinces()
    {
        try {
            $provinces = OngkirHelper::provinces();

            if ($provinces['status']['code'] != 200)
                $this->alert('warning', __('Something went wrong!'));

            $this->provinces = $provinces['results'];
        } catch (Exception $e) {
            $this->alert('warning', __('Something went wrong!'), ['text' => $e->getMessage()]);
        } catch (Throwable $e) {
            $this->alert('warning', __('Something went wrong!'), ['text' => $e->getMessage()]);
        }
    }

    public function set_cities()
    {
        try {
            if ($this->province) {
                $cities = OngkirHelper::cities($this->province);

                if ($cities['status']['code'] != 200)
                    $this->alert('warning', __('Something went wrong!'));

                $cities = OngkirHelper::cities($this->province);
                $this->cities = $cities['results'];
                $this->city = 0;
            }
        } catch (Exception $e) {
            $this->alert('warning', __('Something went wrong!'), ['text' => $e->getMessage()]);
        } catch (Throwable $e) {
            $this->alert('warning', __('Something went wrong!'), ['text' => $e->getMessage()]);
        }
    }

    public function set_shipping_cost()
    {
        try {
            $shipping = OngkirHelper::shipping_cost($this->city, $this->carts->sum(fn ($q) => $q->qty * $q->product->weight));
            $this->shipping_cost = $shipping['cost'];
            $this->estimation_day = $shipping['estimation_day'];
        } catch (Exception $e) {
            $this->shipping_cost = 0;
            $this->estimation_day = 0;
            $this->alert('warning', __('Something went wrong!'), ['text' => __('Your destination city is not available for delivery at this time')]);
        } catch (Throwable $e) {
            $this->shipping_cost = 0;
            $this->estimation_day = 0;
            $this->alert('warning', __('Something went wrong!'), ['text' => __('Your destination city is not available for delivery at this time')]);
        }
    }

    public function store_transaction()
    {
        $this->validate();
        DB::beginTransaction();
        try {
            $this->button_enable = false;
            if (!collect($this->carts)->count())
                return $this->alert(
                    'warning',
                    __('There are no products you added to your cart')
                );

            if ($this->shipping_cost == 0)
                return $this->alert(
                    'warning',
                    __('Something went wrong!'),
                    ['text' => __('Please update this transaction page and then repeat your transaction process')]
                );

            $shipping_cost = OngkirHelper::cost($this->city, $this->carts->sum(fn ($q) => $q->qty * $q->product->weight));

            $transaction = Transaction::create([
                'orderer_name' => $this->orderer_name,
                'address' => $this->address,
                'phone_number' => $this->phone_number,
                'user_id' => Auth::id(),
                'date' => Carbon::now(),
                'unique_code' => rand(0, 99)
            ]);

            Shipping::create([
                'transaction_id' => $transaction->id,
                'courier' => $shipping_cost['results'][0]['code'],
                'courier_name' => $shipping_cost['results'][0]['name'],
                'origin_id' => $shipping_cost['origin_details']['city_id'],
                'origin' => $shipping_cost['origin_details']['city_name'],
                'city_id' => $shipping_cost['destination_details']['city_id'],
                'city' => $shipping_cost['destination_details']['city_name'],
                'province' => $shipping_cost['destination_details']['province'],
                'province_id' => $shipping_cost['destination_details']['province_id'],
                'cost' => collect($shipping_cost['results'][0]['costs'])
                    ->where('service', 'REG')->collapse()['cost'][0]['value'],
                'estimation_day' => collect($shipping_cost['results'][0]['costs'])
                    ->where('service', 'REG')->collapse()['cost'][0]['etd'],
                'note' => collect($shipping_cost['results'][0]['costs'])
                    ->where('service', 'REG')->collapse()['cost'][0]['note'],
                'weight' => $this->carts->sum(fn ($q) => $q->product->weight),
                'type' => 'REG',
                'payload' => $shipping_cost,
            ]);

            foreach ($this->carts as $cart)
                DetailTransaction::create([
                    'transaction_id' => $transaction->id,
                    'product_id' => $cart->product_id,
                    'qty' => $cart->qty,
                    'price' => $cart->product->price,
                    'cost' => $cart->product->cost,
                    'discount' => $cart->product->discount,
                ]);

            Cart::whereIn('id', collect($this->carts)->pluck('id')->toArray())
                ->delete();

            DB::commit();
            $this->redirect(route('profile.history.detail', base64_encode($transaction->id)), true);
        } catch (Exception $e) {
            $this->button_enable = true;
            DB::rollBack();
            $this->alert('warning', __('Something went wrong!'), ['text' => $e->getMessage()]);
        } catch (Throwable $e) {
            $this->button_enable = true;
            DB::rollBack();
            $this->alert('warning', __('Something went wrong!'), ['text' => $e->getMessage()]);
        }
    }
}
