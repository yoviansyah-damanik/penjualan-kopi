<?php

namespace App\Livewire\Frontend\Home;

use App\Models\User;
use App\Models\Product;
use Livewire\Component;
use App\Models\Transaction;
use App\Enums\TransactionStatusType;
use App\Enums\UserStatusType;
use App\Models\Category;

class Facts extends Component
{
    public function render()
    {
        $categories = Category::count();
        $products = Product::count();
        $transactions = Transaction::status(TransactionStatusType::Completed)
            ->count();
        $users = User::role('User')
            ->where('status', UserStatusType::Active)
            ->count();

        return view('livewire.frontend.home.facts', compact('categories', 'products', 'transactions', 'users'));
    }
}
