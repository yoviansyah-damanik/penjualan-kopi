<?php

namespace App\Livewire\Backend\DirectPurchase;

use App\Enums\PaymentStatusType;
use Carbon\Carbon;
use App\Models\Payment;
use App\Models\Product;
use Livewire\Component;
use App\Models\Shipping;
use App\Models\PaymentVendor;
use Livewire\Attributes\Rule;
use App\Enums\TransactionType;
use App\Models\DetailTransaction;
use Illuminate\Support\Facades\DB;
use App\Enums\TransactionStatusType;
use Illuminate\Support\Facades\Auth;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use App\Models\Transaction as ModelsTransaction;

class Transaction extends Component
{
    use LivewireAlert;
    protected $listeners = ['get_product'];

    public $product_list = [];
    public $amount;
    public $qty;
    public $invoice_number;

    #[Rule('required|string|min:3|max:200')]
    public $orderer_name;
    #[Rule('nullable|string|min:3')]
    public $address;
    #[Rule('nullable|numeric|digits_between:11,13')]
    public $phone_number;

    public function mount()
    {
        $this->amount = 0;
        $this->qty = 0;
        $this->invoice_number = "INV/" . sprintf('%05d', (int) ModelsTransaction::count() + 1) . "/" . Carbon::now()->format('m') . "/" . Carbon::now()->format('Y');
    }

    public function render()
    {
        return view('livewire.backend.direct-purchase.transaction');
    }

    public function validationAttributes()
    {
        return [
            'orderer_name' => __('Orderer Name'),
            'address' => __('Address'),
            'phone_number' => __('Phone Number'),
            'product_list' => __('Product List'),
        ];
    }

    public function get_product(Product $product)
    {
        $exist = collect($this->product_list)
            ->contains('id', $product->id);

        if ($exist) {
            $this->increment($product->id);
        } else {
            $this->product_list = collect($this->product_list)
                ->push([
                    ...$product->only('id', 'name', 'price', 'cost', 'discount', 'final_price', 'category_name', 'weight'),
                    'qty' => 1,
                    'total' => $product->final_price
                ]);
        }

        $this->set_calculation();
    }

    public function increment($id)
    {
        $this->product_list = collect($this->product_list)
            ->map(fn ($q) =>  $q['id'] == $id ? [...$q, 'qty' => $q['qty'] + 1, 'total' => ($q['qty'] + 1) * $q['final_price']] : $q)
            ->filter(fn ($q) => $q['qty'] > 0);

        $this->set_calculation();
    }

    public function decrement($id)
    {
        $this->product_list = collect($this->product_list)
            ->map(fn ($q) =>  $q['id'] == $id ? [...$q, 'qty' => $q['qty'] - 1, 'total' => ($q['qty'] - 1) * $q['final_price']] : $q)
            ->filter(fn ($q) => $q['qty'] > 0);

        $this->set_calculation();
    }

    public function remove($id)
    {
        $this->product_list = collect($this->product_list)
            ->map(fn ($q) =>  $q['id'] == $id ? [...$q, 'qty' => 0, 'total' => 0 * $q['final_price']] : $q)
            ->filter(fn ($q) => $q['qty'] > 0);
    }

    public function set_calculation()
    {
        $this->amount = collect($this->product_list)
            ->sum(fn ($q) => $q['qty'] * $q['final_price']);
        $this->qty = collect($this->product_list)
            ->sum('qty');
    }

    public function store_transaction()
    {
        $this->validate();
        DB::beginTransaction();
        try {
            if (!collect($this->product_list)->count())
                return $this->alert(
                    'warning',
                    __('There are no products you added to your cart')
                );

            $transaction = \App\Models\Transaction::create([
                'orderer_name' => $this->orderer_name,
                'address' => $this->address,
                'phone_number' => $this->phone_number,
                'user_id' => Auth::id(),
                'date' => Carbon::now(),
                'unique_code' => 0,
                'status' => TransactionStatusType::Completed,
                'type' => TransactionType::DirectPurchase
            ]);

            foreach ($this->product_list as $product)
                DetailTransaction::create([
                    'transaction_id' => $transaction->id,
                    'product_id' => $product['id'],
                    'qty' => $product['qty'],
                    'price' => $product['price'],
                    'cost' => $product['cost'],
                    'discount' => $product['discount'],
                ]);

            Shipping::create([
                'transaction_id' => $transaction->id,
                'courier' => __('Direct Purchase'),
                'courier_name' => __('Direct Purchase'),
                'origin_id' => 0,
                'origin' => __('Direct Purchase'),
                'city_id' => 0,
                'city' => __('Direct Purchase'),
                'province' => __('Direct Purchase'),
                'province_id' => 0,
                'cost' => 0,
                'estimation_day' => 0,
                'note' => __('Direct Purchase'),
                'weight' => collect($this->product_list)->sum(fn ($q) => $q['weight'] * $q['qty']),
                'type' => 'REG',
                'payload' => "{}",
            ]);

            Payment::create([
                'transaction_id' => $transaction->id,
                'payment_vendor_id' => PaymentVendor::DIRECT_PURCHASE,
                'image' => null,
                'status' => PaymentStatusType::PaidOff
            ]);

            DB::commit();
            $this->redirect(route('dashboard.transaction.show', base64_encode($transaction->id)), true);
        } catch (\Exception $e) {
            DB::rollBack();
            $this->alert('warning', __('Something went wrong!'), ['text' => $e->getMessage()]);
        } catch (\Throwable $e) {
            DB::rollBack();
            $this->alert('warning', __('Something went wrong!'), ['text' => $e->getMessage()]);
        }
    }
}
