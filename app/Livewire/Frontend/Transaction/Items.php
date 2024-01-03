<?php

namespace App\Livewire\Frontend\Transaction;

use Livewire\Component;

class Items extends Component
{
    public $carts;
    public function mount($carts)
    {
        $this->carts = $carts;
    }

    public function render()
    {
        return view('livewire.frontend.transaction.items');
    }
}
