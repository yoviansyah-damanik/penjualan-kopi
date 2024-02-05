<?php

namespace App\Livewire\Frontend\Product;

use Livewire\Component;

class ShowAmount extends Component
{
    public $product;
    public $qty = 1;

    public function mount($product)
    {
        $this->product = $product;
    }
    public function render()
    {
        return view('livewire.frontend.product.show-amount');
    }

    public function increment()
    {
        $this->qty++;
    }

    public function decrement()
    {
        if ($this->qty > 1)
            $this->qty--;
    }
}
