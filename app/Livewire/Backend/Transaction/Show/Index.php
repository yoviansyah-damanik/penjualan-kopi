<?php

namespace App\Livewire\Backend\Transaction\Show;

use Exception;
use Throwable;
use App\Models\Payment;
use Livewire\Component;
use App\Models\Transaction;
use Livewire\Attributes\Layout;
use App\Enums\PaymentStatusType;
use Illuminate\Support\Facades\DB;
use App\Enums\TransactionStatusType;
use Jantinnerezo\LivewireAlert\LivewireAlert;

#[Layout('components.layouts.backend')]
class Index extends Component
{
    use LivewireAlert;
    protected $listeners = ['refresh_transaction' => '$refresh'];

    public Transaction $transaction;

    public function mount($id)
    {
        $this->transaction = Transaction::findOrFail(base64_decode($id))
            ->load('payment');
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

            Payment::where('transaction_id', $this->transaction->id)->update(
                ['status' => PaymentStatusType::PaidOff]
            );

            DB::commit();
            $this->alert('success', __('The :feature was successfully confirmed.', ['feature' => __('Payment')]));
            $this->redirect(route('dashboard.transaction.show', base64_encode($this->transaction->id)), true);
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

            Payment::where('transaction_id', $this->transaction->id)->update(
                ['status' => PaymentStatusType::WaitingForConfirmation]
            );

            DB::commit();
            $this->alert('success', __('The :feature was successfully canceled.', ['feature' => __('Payment')]));
            $this->redirect(route('dashboard.transaction.show', base64_encode($this->transaction->id)));
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
