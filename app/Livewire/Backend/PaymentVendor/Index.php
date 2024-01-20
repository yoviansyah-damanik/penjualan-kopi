<?php

namespace App\Livewire\Backend\PaymentVendor;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\PaymentVendor;
use Livewire\Attributes\Layout;

#[Layout('components.layouts.backend')]
class Index extends Component
{
    use WithPagination;
    protected $listeners = ['refresh_payment_vendors' => 'clear_search'];

    public $per_page = 20;
    public $search;

    public function render()
    {
        $payment_vendors = PaymentVendor::with('payments')
            ->where('name', 'like', "%$this->search%")
            ->paginate($this->per_page);

        return view('livewire.backend.payment-vendor.index', compact('payment_vendors'))
            ->title(__('Payment Vendors'));
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

    public function setItem($payment_vendor, $type)
    {
        $this->dispatch('set_payment_vendor_data', ['payment_vendor' => $payment_vendor]);
        $this->dispatch('openDrawer', $type);
    }
}
