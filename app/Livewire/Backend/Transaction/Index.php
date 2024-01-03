<?php

namespace App\Livewire\Backend\Transaction;

use Livewire\Component;
use App\Models\Transaction;
use Livewire\Attributes\Url;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;
use App\Enums\TransactionStatusType;

#[Layout('components.layouts.backend')]
class Index extends Component
{
    use WithPagination;
    public $per_page = 20;
    #[Url]
    public $search;

    public function render()
    {
        $transactions = Transaction::with('shipping', 'user')
            ->whereIn('status', [TransactionStatusType::WaitingForConfirmation, TransactionStatusType::WaitingForDelivery, TransactionStatusType::Completed, TransactionStatusType::Canceled])
            ->where('id', 'like', "%$this->search%")
            ->orderBy('status', 'asc')
            ->oldest()
            ->paginate($this->per_page);

        return view('livewire.backend.transaction.index', compact('transactions'))
            ->title(__('All Transactions'));
    }

    public function clear_search($search = '')
    {
        $this->search = $search;
        $this->resetPage();
    }
}
