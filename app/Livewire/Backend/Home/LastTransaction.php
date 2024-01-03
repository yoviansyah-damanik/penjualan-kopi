<?php

namespace App\Livewire\Backend\Home;

use Carbon\Carbon;
use Livewire\Component;
use App\Models\Transaction;
use Livewire\WithPagination;
use App\Enums\TransactionStatusType;

class LastTransaction extends Component
{
    use WithPagination;

    const PER_PAGE = 20;

    public $filter_date;
    public $filter_status;
    public $date;
    public $status;

    public function mount()
    {
        $this->filter_date = ['all', 'today', 'yesterday', 'last_7_days', 'last_14_days', 'last_30_days'];
        $this->filter_status = [TransactionStatusType::WaitingForConfirmation, TransactionStatusType::Canceled, TransactionStatusType::Completed];
        $this->status = [TransactionStatusType::Canceled, TransactionStatusType::Completed, TransactionStatusType::WaitingForConfirmation];
        $this->date = 'all';
    }

    public function render()
    {
        $transactions = Transaction::latest()
            ->whereIn('status', $this->status);

        if ($this->date != 'all') {
            $start_date = Carbon::now();
            $end_date = Carbon::now();
            if ($this->date == 'yesterday') {
                $start_date = $start_date->addDays(-1);
            } elseif ($this->date == 'last_7_days') {
                $start_date = $start_date->addDays(-7);
            } elseif ($this->date == 'last_14_days') {
                $start_date = $start_date->addDays(-14);
            } elseif ($this->date == 'last_30_days') {
                $start_date = $start_date->addDays(-30);
            }

            $transactions = $transactions
                ->whereBetween('date', [$start_date->format('Y-m-d'), $end_date->format('Y-m-d')]);
        }

        $transactions = $transactions->limit(self::PER_PAGE)
            ->get();

        return view('livewire.backend.home.last-transaction', compact('transactions'));
    }

    public function set_date($date)
    {
        $this->validate(
            [
                'date' => 'required|in:' . collect($this->filter_date)->join(',')
            ],
            [],
            ['date' => __('Date')]
        );
        $this->date = $date;
    }
}
