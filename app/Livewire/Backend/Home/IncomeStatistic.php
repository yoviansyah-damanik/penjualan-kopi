<?php

namespace App\Livewire\Backend\Home;

use Carbon\Carbon;
use Livewire\Component;
use App\Models\Transaction;
use Livewire\Attributes\Reactive;
use App\Repository\ProductSalesRepository;

class IncomeStatistic extends Component
{
    #[Reactive]
    public $type;
    #[Reactive]
    public $month;
    #[Reactive]
    public $year;

    public function mount($type, $month, $year)
    {
        $this->type = $type;
        $this->month = $month;
        $this->year = $year;
    }

    public function render()
    {
        $sales_transaction = ProductSalesRepository::getAllWithPopularProducts($this->type, $this->month, $this->year);

        $cost_this_month = $sales_transaction['results']->sum(fn ($q) => $q['results'][0]['total']['cost']);
        $total_net = $sales_transaction['results']->sum(fn ($q) => $q['results'][0]['total']['net']);

        if ($this->type == 'annual') {
            $cost_this_month = $sales_transaction['results']->sum(fn ($q) => $q['results']->sum('total.cost'));
            $total_net = $sales_transaction['results']->sum(fn ($q) => $q['results']->sum('total.net'));
        } else {
            $cost_this_month = $sales_transaction['results']->sum(fn ($q) => $q['results'][0]['total']['cost']);
            $total_net = $sales_transaction['results']->sum(fn ($q) => $q['results'][0]['total']['net']);
        }

        // ddd($sales_transaction);
        return view('livewire.backend.home.income-statistic', compact(
            'cost_this_month',
            'total_net',
        ));
    }
}
