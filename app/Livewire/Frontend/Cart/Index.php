<?php

namespace App\Livewire\Frontend\Cart;

use App\Models\Product;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use App\Models\Cart;

class Index extends Component
{
    use LivewireAlert;
    protected $listeners = ['refresh_cart' => '$refresh', 'add_to_cart'];

    public $is_show = false;

    public function render()
    {
        $carts = collect(Auth::user()
            ->carts
            ->load('product'))
            ->sortByDesc('product.is_ready');

        return view('livewire.frontend.cart.index', compact('carts'));
    }

    public function add_to_cart(Product $product, $qty = 1)
    {
        if (!Auth::check())
            return $this->alert(
                'warning',
                __('Please log in first.')
            );

        if ($product->is_ready == false)
            return $this->alert(
                'warning',
                __('Product is not available at this time')
            );

        $exist = Cart::logged()
            ->where('product_id', $product->id)
            ->first();

        if ($exist) {
            $exist->qty = $exist->qty + $qty;
            $exist->save();
        } else {
            Cart::create([
                'user_id' => Auth::id(),
                'product_id' => $product->id,
                'qty' => $qty
            ]);
        }

        $this->dispatch('refresh_item_cart');
        $this->alert(
            'success',
            __('Successfully added product to cart')
        );
    }
}
