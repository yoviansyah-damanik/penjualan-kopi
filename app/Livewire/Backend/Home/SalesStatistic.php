<?php

namespace App\Livewire\Backend\Home;

use Carbon\Carbon;
use Livewire\Component;
use App\Models\Transaction;
use Livewire\Attributes\Reactive;
use App\Enums\TransactionStatusType;
use App\Repository\ProductSalesRepository;

class SalesStatistic extends Component
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
        $total_transactions = $transactions->count();

        $sales_transaction = ProductSalesRepository::getAllWithPopularProducts($this->type, $this->month, $this->year);

        if ($this->type == 'annual') {
            $sales_this_month = $sales_transaction['results']->sum(fn ($q) => $q['results']->sum('total.sold'));
            $total_sales = $sales_transaction['results']->sum(fn ($q) => $q['results']->sum('total.sales_income'));
            $cost_this_month = $sales_transaction['results']->sum(fn ($q) => $q['results']->sum('total.cost'));
            $total_net = $sales_transaction['results']->sum(fn ($q) => $q['results']->sum('total.net'));
        } else {
            $sales_this_month = $sales_transaction['results']->sum(fn ($q) => $q['results'][0]['total']['sold']);
            $total_sales = $sales_transaction['results']->sum(fn ($q) => $q['results'][0]['total']['sales_income']);
            $cost_this_month = $sales_transaction['results']->sum(fn ($q) => $q['results'][0]['total']['cost']);
            $total_net = $sales_transaction['results']->sum(fn ($q) => $q['results'][0]['total']['net']);
        }

        return view('livewire.backend.home.sales-statistic', compact(
            'waiting_for_confirmation_transactions',
            'waiting_for_delivery_transactions',
            'completed_transactions',
            'canceled_transactions',
            'total_transactions',
            'sales_this_month',
            'total_sales',
            'cost_this_month',
            'total_net',
        ));
    }
}
