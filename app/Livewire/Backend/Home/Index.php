<?php

namespace App\Livewire\Backend\Home;

use Carbon\Carbon;
use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('components.layouts.backend')]
class Index extends Component
{
    public $month;
    public $year;
    public $products;
    public $type;
    public $start_date;
    public $end_date;

    public function mount()
    {
        $this->type = 'monthly';
        $this->month = Carbon::now()->month;
        $this->year = Carbon::now()->year;
    }

    public function render()
    {
        if ($this->type == 'annual') {
            $this->start_date = Carbon::createFromFormat('m-Y', $this->month . '-' . $this->year)->startOfYear();
            $this->end_date = Carbon::createFromFormat('m-Y', $this->month . '-' . $this->year)->endOfYear();
        } else {
            $this->start_date = Carbon::createFromFormat('m-Y', $this->month . '-' . $this->year)->startOfMonth();
            $this->end_date = Carbon::createFromFormat('m-Y', $this->month . '-' . $this->year)->endOfMonth();
        }
        return view('livewire.backend.home.index')
            ->title(__('Dashboard'));
    }

    public function rules()
    {
        return [
            'month' => 'required|numeric|min:1|max:12',
            'year' => 'required|numeric|max:' . Carbon::now()->year
        ];
    }
}
