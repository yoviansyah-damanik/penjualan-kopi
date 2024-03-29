<?php

namespace App\Livewire\Backend\Home;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Product;
use Livewire\Component;
use Livewire\Attributes\Reactive;
use App\Enums\TransactionStatusType;
use App\Models\Category;
use App\Models\PaymentVendor;

class Statistic extends Component
{
    const LIMIT = 10;
    public $date;
    #[Reactive]
    public $type;
    #[Reactive]
    public $month;
    #[Reactive]
    public $year;
    #[Reactive]
    public $start_date;
    #[Reactive]
    public $end_date;

    public function mount($type, $month, $year, $start_date, $end_date)
    {
        $this->type = $type;
        $this->month = $month;
        $this->year = $year;
        $this->start_date = $start_date;
        $this->end_date = $end_date;
    }

    public function render()
    {
        $start_date = $this->start_date;
        $end_date = $this->end_date;

        $top_products = Product::whereHas(
            'transactions',
            fn ($q) => $q
                ->status(TransactionStatusType::Completed)
                ->whereBetween('date', [$start_date, $end_date])
        )
            ->limit(self::LIMIT)
            ->get()
            ->sortByDesc('successfulTransactionCount');

        $top_users = User::whereHas(
            'transactions',
            fn ($q) =>
            $q->status(TransactionStatusType::Completed)
                ->whereBetween('date', [$start_date, $end_date])
        )
            ->get()
            ->map(function ($user) use ($start_date, $end_date) {
                $transactions = $user
                    ->transactions()
                    ->status(TransactionStatusType::Completed)
                    ->whereBetween('date', [$start_date, $end_date])
                    ->get();

                return [
                    'name' => $user->name,
                    'email' => $user->email,
                    'image_path' => $user->image_path,
                    'number_of_successful_transactions' => $transactions->count(),
                    'purchase_amount' => $transactions->sum('total_payment_products_only'),
                ];
            })
            ->sortByDesc('purchase_amount')
            ->sortByDesc('number_of_successful_transactions')
            ->take(self::LIMIT);

        $total_products = Product::count();
        $total_categories = Category::count();
        $total_payment_vendors = PaymentVendor::count();

        $last_product = Product::latest()->first();
        $last_category = Category::latest()->first();
        $last_payment_vendor = PaymentVendor::latest()->first();
        return view('livewire.backend.home.statistic', compact(
            'top_products',
            'top_users',
            'total_products',
            'total_categories',
            'total_payment_vendors',
            'last_product',
            'last_category',
            'last_payment_vendor',
        ));
    }

    public function set_date($date)
    {
        $this->validate(
            [
                'date' => 'required|in:' . collect($this->filter_date)->join(',')
            ],
            [],
            ['date' => __('Date')]
        );
        $this->date = $date;
    }
}
