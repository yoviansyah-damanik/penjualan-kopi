<?php

namespace App\Livewire\Backend\Report\Sales;

use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('components.layouts.backend')]
class Index extends Component
{
    public function render()
    {
        return view('livewire.backend.report.sales.index')
            ->title(__('Sales Report'));
    }
}
