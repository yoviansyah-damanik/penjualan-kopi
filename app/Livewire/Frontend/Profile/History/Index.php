<?php

namespace App\Livewire\Frontend\Profile\History;

use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        return view('livewire.frontend.profile.history.index')
            ->title(__('Transaction History'))
            ->layout('components.layouts.frontend', [
                'is_sticky' => true
            ]);
    }
}
