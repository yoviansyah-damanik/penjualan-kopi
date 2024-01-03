<?php

namespace App\Livewire\Backend\Transaction;

use Livewire\Component;
use App\Models\Transaction;
use Illuminate\Support\Str;
use Livewire\Attributes\Layout;
use App\Enums\TransactionStatusType;
use Livewire\Attributes\Url;

#[Layout('components.layouts.backend')]
class Type extends Component
{
    public $type;
    public $per_page = 20;
    #[Url]
    public $search;

    public function mount($type)
    {
        $type = Str::of($type)->camel()->ucfirst()->value;
        if (!TransactionStatusType::hasKey($type))
            return $this->redirect(route('dashboard.transaction'));

        $this->type = TransactionStatusType::getValue($type);
    }

    public function render()
    {
        $transactions = Transaction::with('shipping', 'user')
            ->where('status', $this->type)
            ->where('id', 'like', "%$this->search%")
            ->orderBy('status', 'asc')
            ->oldest()
            ->paginate($this->per_page);

        return view('livewire.backend.transaction.index', compact('transactions'))
            ->title(__(':type Transactions', ['type' => __(Str::of(TransactionStatusType::getKey($this->type))->headline()->value)]));
    }
}
