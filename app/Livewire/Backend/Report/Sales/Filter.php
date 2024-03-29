<?php

namespace App\Livewire\Backend\Report\Sales;

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
    public $type;
    public $products;

    public function mount()
    {
        $this->type = 'daily';
        $this->month = Carbon::now()->month;
        $this->year = Carbon::now()->year;
    }

    public function render()
    {
        return view('livewire.backend.report.sales.filter');
    }

    public function rules()
    {
        return [
            'type' => 'required|in:daily,monthly,annual',
            'month' => 'required|numeric|min:1|max:12',
            'year' => 'required|numeric|min:2023|max:' . date('Y'),
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
        $this->reset('products');
        $this->clear_preview();
        try {
            $this->set_data();
        } catch (\Exception $e) {
            $this->alert('error', __('Something went wrong!'), ['text' => $e->getMessage()]);
        } catch (\Throwable $e) {
            $this->alert('error', __('Something went wrong!'), ['text' => $e->getMessage()]);
        }
    }

    public function print()
    {
        $this->validate();
        $this->set_data();
        try {
            if ($this->type == 'daily')
                $filename = __('Sales Report') . ' - ' . __('Daily') . ' - ' . Carbon::createFromFormat('m', $this->month)->translatedFormat('F') . ' - ' . $this->year . '.pdf';
            elseif ($this->type == 'monthly')
                $filename = __('Sales Report') . ' - ' . __('Monthly') . ' - ' . Carbon::createFromFormat('m', $this->month)->translatedFormat('F') . ' - ' . $this->year . '.pdf';
            else
                $filename = __('Sales Report') . ' - ' . __('Annual') . ' - ' . $this->year . '.pdf';

            $view = $this->type == 'daily' ? 'printout.report.sales_daily' : ($this->type == 'monthly' ?  'printout.report.sales_monthly' : 'printout.report.sales_annual');
            $paper_layout = $this->type == 'monthly' ? 'portrait' : 'landscape';

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
        $products = ProductSalesRepository::getAllWithPopularProducts($this->type, $this->month, $this->year);
        if (!count($products['results'])) {
            $this->alert('warning', __('No :data found.', ['data' => __('product')]));
        } else {
            $this->products = $products;
            $this->dispatch('set_preview', ['type' => $this->type, 'month' => $this->month, 'year' => $this->year, 'products' => $this->products]);
        }
    }
}
