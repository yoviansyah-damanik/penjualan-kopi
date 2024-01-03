<?php

namespace App\Livewire\Frontend\Product;

use Livewire\Component;

class ShowAmount extends Component
{
    public $product;
    public $amount = 1;

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
        $this->amount++;
    }

    public function decrement()
    {
        if ($this->amount > 1)
            $this->amount--;
    }
}
