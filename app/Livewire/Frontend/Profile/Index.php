<?php

namespace App\Livewire\Frontend\Profile;

use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        return view('livewire.frontend.profile.index')
            ->title(__('Profile'))
            ->layout('components.layouts.frontend', [
                'is_sticky' => true
            ]);
    }
}
