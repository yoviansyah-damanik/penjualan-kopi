<?php

namespace App\Livewire\Backend\DirectPurchase;

use Livewire\Component;
use App\Models\Product as ProductModel;

class Product extends Component
{
    const LIMIT = 20;

    public $search;

    public function mount()
    {
        $this->search = '';
    }

    public function render()
    {
        $products = ProductModel::where('id', 'like', "%$this->search%")
            ->orWhere('name', 'like', "%$this->search%")
            ->limit(self::LIMIT)
            ->get();

        return view('livewire.backend.direct-purchase.product', compact('products'));
    }

    public function send_to_transaction(ProductModel $product)
    {
        $this->dispatch('get_product', $product->slug);
    }

    public function  clear_search()
    {
        $this->search = '';
    }
}
