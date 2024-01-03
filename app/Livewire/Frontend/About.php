<?php

namespace App\Livewire\Frontend;

use Livewire\Component;

class About extends Component
{
    public function render()
    {
        return view('livewire.frontend.about')
            ->title(__('About Us'))
            ->layout('components.layouts.frontend', [
                'is_sticky' => true
            ]);
    }
}
