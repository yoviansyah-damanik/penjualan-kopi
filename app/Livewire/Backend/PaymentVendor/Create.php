<?php

namespace App\Livewire\Backend\PaymentVendor;

use App\Models\PaymentVendor;
use Exception;
use Throwable;
use Livewire\Component;
use Livewire\Attributes\Rule;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\WithFileUploads;

class Create extends Component
{
    use LivewireAlert, WithFileUploads;

    #[Rule('required|image|max:2048')]
    public $image;
    #[Rule('required|string|min:3|max:20')]
    public $name;
    #[Rule('required|string|min:3|max:20')]
    public $account_number;
    #[Rule('required|string|min:3|max:200')]
    public $description;

    public function render()
    {
        return view('livewire.backend.payment-vendor.create');
    }

    public function validationAttributes()
    {
        return [
            'name' => __(':name Name', ['name' => __('Payment Vendor')]),
            'image' => __('Image'),
            'account_number' => __('Account Number'),
            'description' => __('Description')
        ];
    }

    public function store_payment_vendor()
    {
        $this->validate();
        try {
            $new_payment_vendor = new PaymentVendor();
            $new_payment_vendor->name = $this->name;
            $new_payment_vendor->description = $this->description;
            $new_payment_vendor->account_number = $this->account_number;
            $new_payment_vendor->image = $this->image->store('payment-vendor-images', 'public');
            $new_payment_vendor->save();

            $this->alert('success', __('The :feature was successfully created.', ['feature' => __('Payment Vendor')]));
            $this->dispatch('refresh_payment_vendors', $new_payment_vendor->name);
            $this->dispatch('closeDrawer', 'drawer-create-payment-vendor-default');
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
