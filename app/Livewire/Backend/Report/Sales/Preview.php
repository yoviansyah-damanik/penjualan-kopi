<?php

namespace App\Livewire\Backend\Report\Sales;

use Livewire\Component;

class Preview extends Component
{
    protected $listeners = ['set_preview', 'refresh_preview'];

    public $is_show = false;
    public $month;
    public $products;
    public $year;
    public $type;
    public $transactions;

    public function render()
    {
        return view('livewire.backend.report.sales.preview');
    }

    public function set_preview($data)
    {
        $this->is_show = true;
        $this->set_data($data);
    }

    protected function set_data($data)
    {
        $this->month = $data['month'];
        $this->year = $data['year'];
        $this->type = $data['type'];
        $this->products = $data['products'];
        // ddd($this->products);
    }

    public function refresh_preview()
    {
        $this->reset();
        $this->is_show = false;
    }
}
