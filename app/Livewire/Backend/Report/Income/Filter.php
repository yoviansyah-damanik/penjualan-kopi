<?php

namespace App\Livewire\Backend\Report\Income;

use Carbon\Carbon;
use Livewire\Component;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use App\Repository\ProductSalesRepository;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class Filter extends Component
{
    use LivewireAlert;
    public $month;
    public $year;
    public $products;
    public $type;
    public $popular_products;

    public function mount()
    {
        $this->type = 'monthly';
        $this->month = Carbon::now()->month;
        $this->year = Carbon::now()->year;
    }

    public function render()
    {
        return view('livewire.backend.report.income.filter');
    }

    public function rules()
    {
        return [
            'type' => 'required|in:monthly,annual,annual_recap',
            'month' => 'required|numeric|min:1|max:12',
            'year' => 'required|numeric|min:2023|max:' . Carbon::now()->year,
        ];
    }

    public function validationAttributes()
    {
        return [
            'type' => __('Type'),
            'month' => __('Month'),
            'year' => __('Year')
        ];
    }

    public function preview()
    {
        $this->validate();
        $this->clear_preview();
        try {
            $this->set_data();
            $this->dispatch('set_preview', ['type' => $this->type, 'month' => $this->month, 'year' => $this->year, 'products' => $this->products]);
        } catch (\Exception $e) {
            $this->alert('error', __('Something went wrong!'));
        } catch (\Throwable $e) {
            $this->alert('error', __('Something went wrong!'));
        }
    }

    public function print()
    {
        $this->validate();
        $this->set_data();
        try {
            $filename = $this->type == 'monthly' ?
                __('Income Report') . ' - ' . __('Monthly') . ' - ' . Carbon::createFromFormat('m', $this->month)->translatedFormat('F') . ' - ' . $this->year . '.pdf'
                : ($this->type == 'annual_recap' ?
                    __('Income Report') . ' - ' . __('Annual Recap') . ' - ' . Carbon::createFromFormat('m', $this->month)->translatedFormat('F') . ' - ' . $this->year . '.pdf'
                    :
                    __('Income Report') . ' - ' . __('Annual') . ' - ' . $this->year . '.pdf'
                );

            $view = $this->type == 'monthly' ? 'printout.report.income_monthly' : ($this->type == 'annual' ? 'printout.report.income_annual' : 'printout.report.income_annual_recap');
            $paper_layout = $this->type == 'annual' ? 'landscape' : 'portrait';

            $pdf = PDF::loadView($view, ['month' => $this->month, 'year' => $this->year, 'products' => $this->products])
                ->setPaper('A4', $paper_layout)
                ->output();

            return response()->streamDownload(
                function () use ($pdf) {
                    print($pdf);
                },
                $filename
            );
        } catch (\Exception $e) {
            $this->alert('warning', __('Something went wrong!'), ['text' => $e->getMessage()]);
        } catch (\Throwable $e) {
            $this->alert('warning', __('Something went wrong!'), ['text' => $e->getMessage()]);
        }
    }

    public function clear_preview()
    {
        $this->dispatch('refresh_preview');
    }

    protected function set_data()
    {
        $this->products = ProductSalesRepository::getAllWithHighestIncome($this->type, $this->month, $this->year);
    }
}
