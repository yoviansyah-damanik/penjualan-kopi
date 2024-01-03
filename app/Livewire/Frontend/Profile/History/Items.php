<?php

namespace App\Livewire\Frontend\Profile\History;

use Livewire\Component;
use App\Models\Transaction;
use Livewire\Attributes\Url;
use Livewire\WithPagination;
use App\Enums\TransactionStatusType;

class Items extends Component
{
    use WithPagination;
    protected $listeners = ['set_filter'];
    public $per_page = 5;

    #[Url]
    public $filter;

    public function mount()
    {
        $this->filter = 'all';
    }

    public function render()
    {
        $transactions = Transaction::with('details', 'shipping', 'delivery', 'details.product', 'details.product.category');

        if ($this->filter != 'all')
            $transactions = $transactions->where('status', $this->filter);

        $transactions = $transactions
            ->logged()
            ->latest()
            ->paginate($this->per_page);


        return view('livewire.frontend.profile.history.items', compact('transactions'));
    }

    public function set_filter($filter)
    {
        $this->filter = $filter != 'all' ? TransactionStatusType::getValue($filter) : $filter;
    }
}
