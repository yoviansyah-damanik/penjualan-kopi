<?php

namespace App\Livewire\Backend\Transaction\Show;

use App\Enums\PaymentStatusType;
use App\Enums\TransactionStatusType;
use Exception;
use Throwable;
use Livewire\Component;
use App\Models\Transaction;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\DB;
use Jantinnerezo\LivewireAlert\LivewireAlert;

#[Layout('components.layouts.backend')]
class Index extends Component
{
    use LivewireAlert;
    protected $listeners = ['refresh_transaction' => '$refresh'];

    public Transaction $transaction;

    public function mount($id)
    {
        $this->transaction = Transaction::findOrFail(base64_decode($id));
    }

    public function render()
    {
        return view('livewire.backend.transaction.show.index')
            ->title(__('Transaction Number') . ': ' . $this->transaction->id);
    }

    public function confirmation_payment()
    {
        DB::beginTransaction();
        try {
            $this->transaction->update([
                'status' => TransactionStatusType::WaitingForDelivery
            ]);

            $this->transaction->payment->update(
                ['status' => PaymentStatusType::PaidOff]
            );

            DB::commit();
            $this->alert('success', __('The :feature was successfully confirmed.', ['feature' => __('Payment')]));
        } catch (Exception $e) {
            DB::rollBack();
            $this->alert('warning', __('Something went wrong!'), ['text' => $e->getMessage()]);
        } catch (Throwable $e) {
            DB::rollBack();
            $this->alert('warning', __('Something went wrong!'), ['text' => $e->getMessage()]);
        }
    }

    public function cancel_payment()
    {
        DB::beginTransaction();
        try {
            $this->transaction->update([
                'status' => TransactionStatusType::WaitingForConfirmation
            ]);

            $this->transaction->payment->update(
                ['status' => PaymentStatusType::WaitingForConfirmation]
            );

            DB::commit();
            $this->alert('success', __('The :feature was successfully updated.', ['feature' => __('Payment')]));
        } catch (Exception $e) {
            DB::rollBack();
            $this->alert('warning', __('Something went wrong!'), ['text' => $e->getMessage()]);
        } catch (Throwable $e) {
            DB::rollBack();
            $this->alert('warning', __('Something went wrong!'), ['text' => $e->getMessage()]);
        }
    }

    public function cancel_order()
    {
        if ($this->transaction->status != TransactionStatusType::WaitingForConfirmation)
            return $this->alert('error', __('Action cannot be performed'));

        DB::beginTransaction();
        try {
            $this->transaction->update([
                'status' => TransactionStatusType::Canceled
            ]);
            $this->transaction->payment->delete();

            DB::commit();
            $this->alert('success', __('The :feature was successfully updated.', ['feature' => __('Order')]));
        } catch (Exception $e) {
            DB::rollBack();
            $this->alert('warning', __('Something went wrong!'), ['text' => $e->getMessage()]);
        } catch (Throwable $e) {
            DB::rollBack();
            $this->alert('warning', __('Something went wrong!'), ['text' => $e->getMessage()]);
        }
    }
}
