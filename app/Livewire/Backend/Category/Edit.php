<?php

namespace App\Livewire\Backend\Category;

use Exception;
use Throwable;
use Livewire\Component;
use App\Models\Category;
use Livewire\Attributes\Rule;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class Edit extends Component
{
    use LivewireAlert;

    protected $listeners = ['set_category_data'];

    public $category;

    #[Rule('required|string|min:3|max:20')]
    public $name;

    #[Rule('required|string|min:3|max:200')]
    public $description;

    public function render()
    {
        return view('livewire.backend.category.edit');
    }

    public function set_category_data(Category $category)
    {
        $this->category = $category;
        $this->name = $category->name;
        $this->description = $category->description;
    }

    public function validationAttributes()
    {
        return [
            'name' => __(':name Name', ['name' => __('Category')]),
            'description' => __('Description')
        ];
    }

    public function update_category()
    {
        $this->validate();
        try {
            $category = $this->category;
            $category->name = $this->name;
            $category->slug = null;
            $category->description = $this->description;
            $category->save();

            $this->alert('success', __('The :feature was successfully updated.', ['feature' => __('Category')]));
            $this->dispatch('refresh_categories', $category->name);
            $this->dispatch('closeDrawer', 'drawer-update-category-default');
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
