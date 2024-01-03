<?php

namespace App\Livewire\Backend\Report\Income;

use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('components.layouts.backend')]
class Index extends Component
{
    public function render()
    {
        return view('livewire.backend.report.income.index')
            ->title(__('Income Report'));
    }
}
