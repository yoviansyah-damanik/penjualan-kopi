<?php

namespace App\Livewire\Backend\DirectPurchase;

use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('components.layouts.backend')]
class Index extends Component
{
    public function render()
    {
        return view('livewire.backend.direct-purchase.index')
            ->title(__('Direct Purchase'));
    }
}
