<?php

namespace App\Livewire\Frontend\Home;

use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('components.layouts.frontend')]
class Index extends Component
{
    public function render()
    {
        return view('livewire.frontend.home.index');
    }
}
