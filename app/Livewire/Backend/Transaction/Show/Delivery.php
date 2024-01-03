<?php

namespace App\Livewire\Backend\Transaction\Show;

use App\Enums\TransactionStatusType;
use Exception;
use Throwable;
use Livewire\Component;
use App\Models\Transaction;
use Illuminate\Support\Facades\DB;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Rule;

class Delivery extends Component
{
    use LivewireAlert;
    public Transaction $transaction;

    #[Rule('required|string|max:200')]
    public $code;
    #[Rule('nullable|string|max:200')]
    public $description;

    public function mount(Transaction $transaction)
    {
        $this->transaction = $transaction;
        if ($transaction->delivery) {
            $this->code = $transaction->delivery->code;
            $this->description = $transaction->delivery->description;
        }
    }

    public function render()
    {
        return view('livewire.backend.transaction.show.delivery');
    }

    public function validationAttributes()
    {
        return [
            'code' => __('Delivery Code'),
            'description' => __('Description'),
        ];
    }

    public function store_delivery()
    {
        $this->validate();
        DB::beginTransaction();
        try {
            \App\Models\Delivery::updateOrCreate(
                [
                    'transaction_id' => $this->transaction->id
                ],
                [
                    'code' => $this->code,
                    'description' => $this->description,
                ]
            );

            $this->transaction->update(['status' => TransactionStatusType::Completed]);

            DB::commit();
            $this->dispatch('refresh_transaction');
            $this->alert('success', __('The :feature was successfully updated.', ['feature' => __('Delivery')]));
        } catch (Exception $e) {
            DB::rollBack();
            $this->alert('warning', __('Something went wrong!'), ['text' => $e->getMessage()]);
        } catch (Throwable $e) {
            DB::rollBack();
            $this->alert('warning', __('Something went wrong!'), ['text' => $e->getMessage()]);
        }
    }
}
