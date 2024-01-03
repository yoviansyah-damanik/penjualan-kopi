<?php

namespace App\Livewire\Backend\Product;

use Exception;
use Throwable;
use App\Models\Product;
use Livewire\Component;
use Illuminate\Support\Facades\Storage;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class Delete extends Component
{
    use LivewireAlert;
    protected $listeners = ['set_product_data'];

    public $product;
    public $name;
    public $category;
    public function render()
    {
        return view('livewire.backend.product.delete');
    }

    public function set_product_data(Product $product)
    {
        $this->product = $product;
        $this->name = $product->name;
        $this->category = $product->category_name;
    }

    public function delete_product()
    {
        try {
            // if ($this->product->additional_images)
            //     foreach (explode(';', $this->product->additional_images) as $image)
            //         Storage::disk('public')->delete($image);

            // Storage::disk('public')->delete($this->product->main_image);

            $this->product->delete();

            $this->alert('success', __('The :feature was successfully deleted.', ['feature' => __('Product')]));
            $this->dispatch('refresh_products');
            $this->dispatch('closeDrawer', 'drawer-delete-product-default');
            $this->reset();
        } catch (Exception $e) {
            $this->alert('warning', __('Something went wrong!'), ['text' => $e->getMessage()]);
        } catch (Throwable $e) {
            $this->alert('warning', __('Something went wrong!'), ['text' => $e->getMessage()]);
        }
    }
}
