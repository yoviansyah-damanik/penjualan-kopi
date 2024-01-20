<?php

namespace App\Livewire\Backend\Product;

use App\Models\Product;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\WithPagination;

#[Layout('components.layouts.backend')]
class Index extends Component
{
    use WithPagination;
    protected $listeners = ['refresh_products' => 'clear_search'];

    public $per_page = 20;
    public $search;

    public function render()
    {
        $products = Product::with('category')
            ->where(function ($q) {
                return $q->where('name', 'like', "%$this->search%")
                    ->orWhere('id', 'like', "%$this->search%");
            })
            ->paginate($this->per_page);

        return view('livewire.backend.product.index', compact('products'))
            ->title(__('Products'));
    }

    public function clear_search($search = '')
    {
        $this->search = $search;
        $this->resetPage();
    }

    public function closeDrawer()
    {
        $this->dispatch('closeDrawer');
    }

    public function setItem($product, $type)
    {
        $this->dispatch('set_product_data', ['product' => $product]);
        $this->dispatch('openDrawer', $type);
    }
}
