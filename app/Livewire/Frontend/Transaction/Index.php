<?php

namespace App\Livewire\Frontend\Transaction;

use App\Models\Cart;
use Livewire\Component;

class Index extends Component
{
    protected $listeners = ['refresh_transactions' => '$refresh'];

    public function render()
    {
        $carts = Cart::with([
            'product' => fn ($q) => $q->orderBy('is_ready', 'desc'),
            'product.category'
        ])
            ->whereHas('product', function ($q) {
                $q->where('is_ready', true);
            })
            ->logged()
            ->get();

        return view('livewire.frontend.transaction.index', compact('carts'))
            ->title(__('Transactions'))
            ->layout('components.layouts.frontend', [
                'is_sticky' => true
            ]);
    }
}
