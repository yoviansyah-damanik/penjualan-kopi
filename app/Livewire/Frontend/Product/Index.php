<?php

namespace App\Livewire\Frontend\Product;

use App\Models\Category;
use App\Models\Product;
use Livewire\Component;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Url;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    #[Rule('nullable|string')]
    public $search;

    #[Rule('required|numeric')]
    public $per_page;

    #[Url]
    public $category;

    public function mount()
    {
        $this->search = '';
        $this->per_page = 12;
        $this->category = 'all';
    }

    public function search()
    {
        $this->resetPage('products-page');
    }

    public function render()
    {
        $products = Product::where('name', 'like', "%$this->search%")
            ->orderBy('is_ready', 'desc');

        if ($this->category != 'all') {
            if ($this->category == 'uncategorized')
                $products = $products->whereNull('category_id');
            else
                $products = $products->whereHas('category', function ($q) {
                    $q->whereSlug($this->category);
                });
        }

        $products  = $products->paginate($this->per_page, pageName: 'products-page');

        $categories = Category::get();

        return view('livewire.frontend.product.index', [
            'products' => $products,
            'categories' => $categories,
        ])
            ->title(__('Products'))
            ->layout('components.layouts.frontend', [
                'is_sticky' => true
            ]);
    }

    public function set_category($category)
    {
        $this->category = $category;
    }
}
