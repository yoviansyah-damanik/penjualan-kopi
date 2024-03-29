<?php

namespace App\Livewire\Backend\Transaction\Show;

use Exception;
use Throwable;
use App\Models\Payment;
use Livewire\Component;
use App\Jobs\SendMailJob;
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

            dispatch(new SendMailJob($this->transaction, $this->transaction->user->email, 'confirmed'));

            DB::commit();
            $this->closeDrawer();
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

            Payment::where('transaction_id', $this->transaction->id)->update(
                ['status' => PaymentStatusType::WaitingForConfirmation]
            );

            DB::commit();
            $this->alert('success', __('The :feature was successfully canceled.', ['feature' => __('Payment')]));
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

            Payment::where('transaction_id', $this->transaction->id)->delete();

            dispatch(new SendMailJob($this->transaction, $this->transaction->user->email, 'failed'));

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

    public function closeDrawer()
    {
        $this->dispatch('closeDrawer');
    }
}
