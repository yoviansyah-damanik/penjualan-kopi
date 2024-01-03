<?php

namespace App\Livewire\Frontend\Product;

use App\Models\Product;
use Livewire\Component;

class Show extends Component
{
    public Product $product;

    public function mount($product)
    {
        $this->product = $product;
    }

    public function render()
    {
        return view('livewire.frontend.product.show')
            ->title(__($this->product->name))
            ->layout('components.layouts.frontend', [
                'is_sticky' => true
            ]);
    }
}
