<?php

namespace App\Livewire\Backend\Category;

use App\Models\Category;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;

#[Layout('components.layouts.backend')]
class Index extends Component
{
    use WithPagination;
    protected $listeners = ['refresh_categories' => 'clear_search'];

    public $per_page = 20;
    public $search;

    public function render()
    {
        $categories = Category::with('products')
            ->where('name', 'like', "%$this->search%")
            ->paginate($this->per_page);

        return view('livewire.backend.category.index', compact('categories'))
            ->title(__('Categories'));
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

    public function setItem($category, $type)
    {
        $this->dispatch('set_category_data', ['category' => $category]);
        $this->dispatch('openDrawer', $type);
    }
}
