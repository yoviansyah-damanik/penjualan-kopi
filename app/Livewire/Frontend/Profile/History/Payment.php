<?php

namespace App\Livewire\Frontend\Profile\History;

use Exception;
use Throwable;
use Livewire\Component;
use App\Models\Transaction;
use App\Models\PaymentVendor;
use Livewire\WithFileUploads;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use App\Enums\TransactionStatusType;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class Payment extends Component
{
    use WithFileUploads, LivewireAlert;
    public Transaction $transaction;

    public $payment_vendors;
    public $payment_vendor;

    public $evidence;

    public function mount(Transaction $transaction)
    {
        $this->transaction = $transaction;
    }

    public function render()
    {
        $this->payment_vendors = PaymentVendor::show()
            ->get();
        return view('livewire.frontend.profile.history.payment');
    }

    public function rules()
    {
        return [
            'evidence' => 'required|file|image|max:2048',
            'payment_vendor' => [
                'required',
                Rule::in($this->payment_vendors->pluck('id')->toArray())
            ]
        ];
    }
    public function validationAttributes()
    {
        return [
            'evidence' => __('Evidence of Payment'),
            'payment_vendor' => __('Payment vendor'),
        ];
    }

    public function store_payment()
    {
        $this->validate();
        DB::beginTransaction();
        try {
            $this->transaction->update(['status' => TransactionStatusType::WaitingForConfirmation]);

            \App\Models\Payment::create([
                'transaction_id' => $this->transaction->id,
                'payment_vendor_id' => $this->payment_vendor,
                'image' => $this->evidence->store('payment-images', 'public')
            ]);

            DB::commit();
            $this->alert('success', __('The :feature was successfully updated.', ['feature' => __('Payment')]));
            $this->dispatch('refresh_product_show');
        } catch (Exception $e) {
            DB::rollBack();
            $this->alert('warning', __('Something went wrong!'), ['text' => $e->getMessage()]);
        } catch (Throwable $e) {
            DB::rollBack();
            $this->alert('warning', __('Something went wrong!'), ['text' => $e->getMessage()]);
        }
    }
}
