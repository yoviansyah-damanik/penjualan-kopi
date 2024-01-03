<?php

namespace App\Livewire\Frontend\Cart;

use Exception;
use App\Models\Cart;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class Item extends Component
{
    use LivewireAlert;
    protected $listeners = ['refresh_item_cart' => 'count_'];
    public $cart;
    public $qty;
    public $is_show = true;

    public function mount(Cart $cart)
    {
        $this->cart = $cart->load('product');
        $this->count_();
    }

    public function count_()
    {
        $this->qty = $this->cart->refresh()->qty;
    }

    public function render()
    {
        $this->dispatch('refresh_transactions');
        return view('livewire.frontend.cart.item');
    }

    public function increment()
    {
        $this->is_show = false;

        $this->qty++;

        $this->cart->qty = $this->qty;
        $this->cart->save();

        $this->is_show = true;
        $this->dispatch('refresh_cart');
    }

    public function decrement()
    {
        $this->is_show = false;

        if ($this->qty - 1 <= 0)
            return $this->delete();

        $this->qty--;

        $this->cart->qty = $this->qty;
        $this->cart->save();

        $this->is_show = true;
        $this->dispatch('refresh_cart');
    }

    public function delete()
    {
        $this->is_show = false;
        try {
            $this->cart->delete();
            $this->dispatch('refresh_cart');

            $this->alert(
                'success',
                __('The :feature was successfully deleted.', ['feature' => __('Product')])
            );
        } catch (Exception $e) {
            $this->alert(
                'warning',
                __('Something went wrong!')
            );
        }
    }
}
