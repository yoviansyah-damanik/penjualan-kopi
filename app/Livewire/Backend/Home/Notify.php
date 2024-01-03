<?php

namespace App\Livewire\Backend\Home;

use Carbon\Carbon;
use Livewire\Component;
use App\Models\Transaction;
use Livewire\Attributes\Reactive;
use App\Enums\TransactionStatusType;

class Notify extends Component
{
    #[Reactive]
    public $type;
    #[Reactive]
    public $month;
    #[Reactive]
    public $year;
    #[Reactive]
    public $start_date;
    #[Reactive]
    public $end_date;

    public function mount($type, $month, $year, $start_date, $end_date)
    {
        $this->type = $type;
        $this->month = $month;
        $this->year = $year;
        $this->start_date = $start_date;
        $this->end_date = $end_date;
    }

    public function render()
    {
        $transactions = Transaction::whereBetween('date', [$this->start_date, $this->end_date]);
        $waiting_for_confirmation_transactions = $transactions->clone()->status(TransactionStatusType::WaitingForConfirmation)->count();
        $waiting_for_delivery_transactions = $transactions->clone()->status(TransactionStatusType::WaitingForDelivery)->count();
        $completed_transactions = $transactions->clone()->status(TransactionStatusType::Completed)->count();
        $canceled_transactions = $transactions->clone()->status(TransactionStatusType::Canceled)->count();

        return view('livewire.backend.home.notify', compact(
            'waiting_for_confirmation_transactions',
            'waiting_for_delivery_transactions',
            'completed_transactions',
            'canceled_transactions',
        ));
    }
}
