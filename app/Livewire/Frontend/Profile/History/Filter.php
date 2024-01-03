<?php

namespace App\Livewire\Frontend\Profile\History;

use Livewire\Component;

class Filter extends Component
{
    public $filter;

    public function mount()
    {
        $this->filter = 'all';
    }

    public function render()
    {
        return view('livewire.frontend.profile.history.filter');
    }

    public function set_filter($filter)
    {
        $this->filter = $filter;
        $this->dispatch('set_filter', $filter);
    }
}
