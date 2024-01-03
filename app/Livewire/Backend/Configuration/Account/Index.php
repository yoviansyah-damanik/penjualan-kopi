<?php

namespace App\Livewire\Backend\Configuration\Account;

use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('components.layouts.backend')]
class Index extends Component
{
    public function render()
    {
        return view('livewire.backend.configuration.account.index')
            ->title(__('Account'));
    }
}
