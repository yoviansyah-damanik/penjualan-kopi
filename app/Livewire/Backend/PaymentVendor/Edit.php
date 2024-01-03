<?php

namespace App\Livewire\Backend\PaymentVendor;

use Exception;
use Throwable;
use Livewire\Component;
use App\Models\PaymentVendor;
use Livewire\Attributes\Rule;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class Edit extends Component
{
    use LivewireAlert, WithFileUploads;

    protected $listeners = ['set_payment_vendor_data'];

    public $payment_vendor;
    #[Rule('nullable|image|max:2048')]
    public $image;
    #[Rule('required|string|min:3|max:20')]
    public $name;
    #[Rule('required|string|min:3|max:20')]
    public $account_number;
    #[Rule('required|string|min:3|max:200')]
    public $description;

    public function render()
    {
        return view('livewire.backend.payment-vendor.edit');
    }

    public function set_payment_vendor_data(PaymentVendor $payment_vendor)
    {
        $this->payment_vendor = $payment_vendor;
        $this->name = $payment_vendor->name;
        $this->account_number = $payment_vendor->account_number;
        $this->description = $payment_vendor->description;
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

    public function update_payment_vendor()
    {
        $this->validate();
        try {
            $payment_vendor = $this->payment_vendor;
            $payment_vendor->name = $this->name;
            $payment_vendor->description = $this->description;
            $payment_vendor->account_number = $this->account_number;

            if ($this->image) {
                Storage::disk('public')->delete($payment_vendor->image);
                $payment_vendor->image = $this->image->store('payment-vendor-images', 'public');
            }

            $payment_vendor->save();

            $this->alert('success', __('The :feature was successfully updated.', ['feature' => __('Payment Vendor')]));
            $this->dispatch('refresh_payment_vendors', $payment_vendor->name);
            $this->dispatch('closeDrawer', 'drawer-update-payment-vendor-default');
            $this->reset();
        } catch (Exception $e) {
            $this->alert('warning', __('Something went wrong!'), ['text' => $e->getMessage()]);
        } catch (Throwable $e) {
            $this->alert('warning', __('Something went wrong!'), ['text' => $e->getMessage()]);
        }
    }
}
