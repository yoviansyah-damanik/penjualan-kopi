<?php

namespace App\Livewire\Backend\Product;

use Exception;
use Livewire\Component;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Validation\Rule;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\WithFileUploads;
use Throwable;

class Create extends Component
{
    use LivewireAlert, WithFileUploads;

    public $categories;
    public $discount;
    public $name;
    public $price;
    public $cost;
    public $weight;
    public $category;
    public $description;
    public $main_image;
    public $additional_images;
    public $status;

    public function mount()
    {
        $this->init_var();
    }

    public function init_var()
    {
        $this->categories = Category::get();
        $this->category = 0;
        $this->discount = 0;
        $this->weight = 100;
        $this->status = 1;
    }

    public function render()
    {
        return view('livewire.backend.product.create');
    }

    public function rules()
    {
        return [
            'name' => 'required|string|min:3|max:200',
            'price' => 'required|numeric|min:0',
            'discount' => 'required|numeric|min:0|max:' . $this->price,
            'cost' => 'required|numeric|max:' . $this->price - $this->discount,
            'weight' => 'required|numeric|min:0',
            'category' => [
                'required',
                Rule::in([0, ...$this->categories->pluck('id')->toArray()])
            ],
            'description' => 'required|string',
            'main_image' => 'required|image|max:2048',
            'additional_images' => 'nullable',
            'additional_images.*' => 'image|max:2048',
            'status' => 'required|boolean',
        ];
    }

    public function validationAttributes()
    {
        return [
            'name' => __('Product Name'),
            'price' => __('Price'),
            'cost' => __('Cost'),
            'weight' => __('Weight'),
            'category' => __('Category'),
            'description' => __('Description'),
            'main_image' => __('Main Image'),
            'additional_images' => __('Additional Images'),
            'additional_images.*' => __('Additional Images'),
            'status' => __('Status'),
            'discount' => __('Discount'),
        ];
    }

    public function store_product()
    {
        $this->validate();
        try {
            $new_product = new Product();
            $new_product->name = $this->name;
            $new_product->price = $this->price;
            $new_product->cost = $this->cost;
            $new_product->weight = $this->weight;
            $new_product->category_id = $this->category == 0 ? null : $this->category;
            $new_product->description = $this->description;
            $new_product->is_ready = $this->status == 1;
            $new_product->main_image = $this->main_image->store('product-images', 'public');

            $path_of_additional_images = [];
            if ($this->additional_images) {
                foreach ($this->additional_images as $image) {
                    array_push($path_of_additional_images, $image->store('product-images', 'public'));
                }
                $new_product->additional_images = collect($path_of_additional_images)->implode(';');
            }

            $new_product->save();

            $this->alert('success', __('The :feature was successfully created.', ['feature' => __('Product')]));
            $this->dispatch('refresh_products', $new_product->name);
            $this->dispatch('closeDrawer', 'drawer-create-product-default');
            $this->reset();
            $this->init_var();
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
