<?php

namespace App\Livewire\Backend\Category;

use App\Models\Category;
use Exception;
use Throwable;
use Livewire\Component;
use Livewire\Attributes\Rule;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class Create extends Component
{
    use LivewireAlert;

    #[Rule('required|string|min:3|max:20')]
    public $name;

    #[Rule('required|string|min:3|max:200')]
    public $description;

    public function render()
    {
        return view('livewire.backend.category.create');
    }

    public function validationAttributes()
    {
        return [
            'name' => __(':name Name', ['name' => __('Category')]),
            'description' => __('Description')
        ];
    }

    public function store_category()
    {
        $this->validate();
        try {
            $new_category = new Category();
            $new_category->name = $this->name;
            $new_category->description = $this->description;
            $new_category->save();

            $this->alert('success', __('The :feature was successfully created.', ['feature' => __('Category')]));
            $this->dispatch('refresh_categories', $new_category->name);
            $this->dispatch('closeDrawer', 'drawer-create-category-default');
            $this->reset();
        } catch (Exception $e) {
            $this->alert('warning', __('Something went wrong!'), ['text' => $e->getMessage()]);
        } catch (Throwable $e) {
            $this->alert('warning', __('Something went wrong!'), ['text' => $e->getMessage()]);
        }
    }
}
