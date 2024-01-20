<?php

namespace App\Livewire\Backend\Category;

use Exception;
use Throwable;
use App\Models\Product;
use Livewire\Component;
use App\Models\Category;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class Delete extends Component
{
    use LivewireAlert;
    protected $listeners = ['set_category_data'];

    public $category;
    public $name;

    public function render()
    {
        return view('livewire.backend.category.delete');
    }

    public function set_category_data(Category $category)
    {
        $this->category = $category;
        $this->name = $category->name;
    }

    public function delete_category()
    {
        try {
            $this->category->delete();
            Product::where('category_id', $this->category->id)
                ->update(['category_id' => null]);

            $this->alert('success', __('The :feature was successfully deleted.', ['feature' => __('Category')]));
            $this->dispatch('refresh_categories');
            $this->dispatch('closeDrawer', 'drawer-delete-category-default');
            $this->reset();
        } catch (Exception $e) {
            $this->alert('warning', __('Something went wrong!'), ['text' => $e->getMessage()]);
        } catch (Throwable $e) {
            $this->alert('warning', __('Something went wrong!'), ['text' => $e->getMessage()]);
        }
    }

    public function closeDrawer()
    {
        $this->dispatch('closeDrawer');
    }
}
