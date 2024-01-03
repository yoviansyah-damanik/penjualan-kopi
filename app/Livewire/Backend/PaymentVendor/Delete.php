<?php

namespace App\Livewire\Backend\PaymentVendor;

use Exception;
use Throwable;
use Livewire\Component;
use App\Models\PaymentVendor;
use Illuminate\Support\Facades\Storage;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class Delete extends Component
{
    use LivewireAlert;
    protected $listeners = ['set_payment_vendor_delete_data'];

    public $payment_vendor;
    public $name;
    public $account_number;

    public function render()
    {
        return view('livewire.backend.payment-vendor.delete');
    }

    public function set_payment_vendor_delete_data(PaymentVendor $payment_vendor)
    {
        $this->payment_vendor = $payment_vendor;
        $this->name = $payment_vendor->name;
        $this->account_number = $payment_vendor->account_number;
    }

    public function delete_payment_vendor()
    {
        try {
            if ($this->payment_vendor->payments->count() > 0)
                return $this->alert('warning', __('There are payments associated with this payment vendor. Payment vendors cannot be deleted.'));

            if ($this->payment_vendor->image)
                Storage::disk('public')->delete($this->payment_vendor->image);

            $this->payment_vendor->delete();

            $this->alert('success', __('The :feature was successfully deleted.', ['feature' => __('Payment Vendor')]));
            $this->dispatch('refresh_payment_vendors');
            $this->dispatch('closeDrawer', 'drawer-delete-payment-vendor-default');
            $this->reset();
        } catch (Exception $e) {
            $this->alert('warning', __('Something went wrong!'), ['text' => $e->getMessage()]);
        } catch (Throwable $e) {
            $this->alert('warning', __('Something went wrong!'), ['text' => $e->getMessage()]);
        }
    }
}
