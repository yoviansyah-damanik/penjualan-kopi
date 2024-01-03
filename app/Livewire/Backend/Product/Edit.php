<?php

namespace App\Livewire\Backend\Product;

use Exception;
use Throwable;
use App\Models\Product;
use Livewire\Component;
use App\Models\Category;
use Livewire\WithFileUploads;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class Edit extends Component
{
    use LivewireAlert, WithFileUploads;

    protected $listeners = ['set_product_data'];

    public $product;
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

    public function render()
    {
        return view('livewire.backend.product.edit');
    }

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

    public function set_product_data(Product $product)
    {
        $this->product = $product;
        $this->discount = $product->discount;
        $this->name = $product->name;
        $this->price = $product->price;
        $this->cost = $product->cost;
        $this->weight = $product->weight;
        $this->category = $product->category_id ?? 0;
        $this->description = $product->description;
        $this->status = $product->is_ready;
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
            'main_image' => 'nullable|image|max:2048',
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

    public function update_product()
    {
        $this->validate();
        try {
            $product = $this->product;
            $product->name = $this->name;
            $product->slug = null;
            $product->price = $this->price;
            $product->cost = $this->cost;
            $product->weight = $this->weight;
            $product->category_id = $this->category == 0 ? null : $this->category;
            $product->description = $this->description;
            $product->is_ready = $this->status == 1;

            if ($this->main_image) {
                Storage::disk('public')->delete($product->main_image);
                $product->main_image = $this->main_image->store('product-images', 'public');
            }

            $path_of_additional_images = [];
            if ($this->additional_images) {
                foreach ($product->additional_images as $image)
                    Storage::disk('public')->delete($image);

                foreach ($this->additional_images as $image)
                    array_push($path_of_additional_images, $image->store('product-images', 'public'));
            }

            $product->additional_images = collect($path_of_additional_images)->implode(';');
            $product->save();

            $this->alert('success', __('The :feature was successfully updated.', ['feature' => __('Product')]));
            $this->dispatch('refresh_products', $product->name);
            $this->dispatch('closeDrawer', 'drawer-update-product-default');
        } catch (Exception $e) {
            $this->alert('warning', __('Something went wrong!'), ['text' => $e->getMessage()]);
        } catch (Throwable $e) {
            $this->alert('warning', __('Something went wrong!'), ['text' => $e->getMessage()]);
        }
    }
}
