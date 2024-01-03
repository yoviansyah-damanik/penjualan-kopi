<?php

namespace App\Livewire\Frontend\Home;

use App\Models\Product;
use Livewire\Component;

class Products extends Component
{
    const LIMIT = 8;
    public function render()
    {
        $products = Product::with('category')
            ->inRandomOrder()
            ->ready()
            ->limit(self::LIMIT)
            ->get();

        return view('livewire.frontend.home.products', compact('products'));
    }
}
