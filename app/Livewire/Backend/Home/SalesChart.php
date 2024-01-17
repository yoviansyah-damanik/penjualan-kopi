<?php

namespace App\Livewire\Backend\Home;

use Carbon\Carbon;
use Livewire\Component;
use Livewire\Attributes\Reactive;
use App\Repository\ProductSalesRepository;

class SalesChart extends Component
{
    #[Reactive]
    public $type;
    #[Reactive]
    public $month;
    #[Reactive]
    public $year;
    public $total_sold;
    public $total_transactions;

    public function mount($type, $month, $year)
    {
        $this->type = $type;
        $this->month = $month;
        $this->year = $year;
    }

    public function rules()
    {
        return [
            'type' => 'required|in:' . collect($this->filter_type)->join(','),
            'month' => 'required|numeric|min:1|max:12',
            'year' => 'required|numeric|min:2023|max:' . Carbon::now()->year,
        ];
    }

    public function validationAttributes()
    {
        return [
            'type' => __('Type'),
            'month' => __('Month'),
            'year' => __('Year'),
        ];
    }

    public function render()
    {
        $this->set_data();
        return view('livewire.backend.home.sales-chart');
    }

    public function set_data()
    {
        $transaction = ProductSalesRepository::getAllWithHighestIncome($this->type, $this->month, $this->year);

        $series = null;
        $categories = null;
        if ($this->type == 'annual') {
            $categories = collect(range(1, 12))->map(fn ($q) => Carbon::createFromFormat('m', $q)->translatedFormat('F'));
            $series = [
                [
                    'name' => __('Total Sold'),
                    'data' => collect(range(1, 12))->map(function ($month) use ($transaction) {
                        return $transaction['results']->sum('results.' . $month - 1 . '.total.sold');
                    })
                ],
            ];
        } else {
            $categories = collect(range(Carbon::createFromFormat('m-Y', $this->month . '-' . $this->year)->startOfMonth()->day, Carbon::createFromFormat('mY', $this->month . $this->year)->endOfMonth()->day))
                ->map(fn ($q) => $q . ' ' . Carbon::createFromFormat('m', $this->month)->translatedFormat('M'));
            $series = [
                [
                    'name' => __('Total Sold'),
                    'data' => collect(range(Carbon::createFromFormat('m-Y', $this->month . '-' . $this->year)->startOfMonth()->day, Carbon::createFromFormat('mY', $this->month . $this->year)->endOfMonth()->day))
                        ->map(function ($day) use ($transaction) {
                            return $transaction['results']->sum(fn ($q) => $q['results']->sum('results.' . $day - 1 . '.sold'));
                        }),
                ],
            ];
        }

        $this->total_sold = $transaction['total_sales']['sold'];
        $this->dispatch('setDataSales', ['type' => $this->type,  'series' => $series, 'categories' => $categories, 'month' => Carbon::createFromFormat('m', $this->month)->translatedFormat('F'), 'year' => $this->year]);
    }
}
