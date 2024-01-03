<?php

namespace App\Livewire\Frontend\Profile\History;

use App\Enums\DeliveryStatusType;
use Exception;
use Throwable;
use Livewire\Component;
use App\Models\Transaction;
use App\Enums\TransactionStatusType;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class Item extends Component
{
    use LivewireAlert;

    public Transaction $transaction;

    public function mount($transaction)
    {
        $this->transaction = $transaction;
    }

    public function render()
    {
        return view('livewire.frontend.profile.history.item');
    }

    public function cancel()
    {
        if ($this->transaction->status != TransactionStatusType::WaitingForPayment)
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
}
