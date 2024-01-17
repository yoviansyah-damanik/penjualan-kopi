<?php

namespace App\Livewire\Frontend\Profile\History;

use Exception;
use Throwable;
use Livewire\Component;
use App\Models\Transaction;
use App\Enums\DeliveryStatusType;
use App\Enums\TransactionStatusType;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class Show extends Component
{
    use LivewireAlert;
    protected $listeners = ['refresh_product_show' => '$refresh'];
    public Transaction $transaction;

    public function mount($id)
    {
        $this->transaction = Transaction::findOrFail(base64_decode($id));
    }

    public function render()
    {
        return view('livewire.frontend.profile.history.show')
            ->title(__('Transaction History') . ' ' . $this->transaction->id)
            ->layout('components.layouts.frontend', [
                'is_sticky' => true
            ]);
    }

    public function complete()
    {
        if ($this->transaction->status != TransactionStatusType::Completed)
            return $this->alert('error', __('Action cannot be performed'), ['text' => __('This transaction has not yet been completed.')]);
        try {
            $this->transaction->delivery->update([
                'status' => DeliveryStatusType::Arrived
            ]);

            $this->alert('success', __('The :feature was successfully updated.', ['feature' => __('Order')]));
        } catch (Exception $e) {
            $this->alert('warning', __('Something went wrong!'), ['text' => $e->getMessage()]);
        } catch (Throwable $e) {
            $this->alert('warning', __('Something went wrong!'), ['text' => $e->getMessage()]);
        }
    }

    public function cancel()
    {
        if (!in_array($this->transaction->status, [
            \App\Enums\TransactionStatusType::WaitingForPayment,
            \App\Enums\TransactionStatusType::WaitingForConfirmation,
        ]))
            return $this->alert('error', __('Action cannot be performed'));

        try {
            $this->transaction->update([
                'status' => TransactionStatusType::Canceled
            ]);

            $this->alert('success', __('The :feature was successfully updated.', ['feature' => __('Order')]));
        } catch (Exception $e) {
            $this->alert('warning', __('Something went wrong!'), ['text' => $e->getMessage()]);
        } catch (Throwable $e) {
            $this->alert('warning', __('Something went wrong!'), ['text' => $e->getMessage()]);
        }
    }
}
