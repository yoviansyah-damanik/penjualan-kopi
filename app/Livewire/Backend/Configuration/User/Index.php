<?php

namespace App\Livewire\Backend\Configuration\User;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Url;
use Livewire\WithPagination;

#[Layout('components.layouts.backend')]
class Index extends Component
{
    use WithPagination;

    protected $listeners = ['refresh_users' => '$refresh'];
    #[Url]
    public $search;
    #[Url]
    public $filter;
    public $per_page = 20;

    public function mount()
    {
        $this->search = '';
        $this->filter = 'all';
    }

    public function render()
    {
        $users = \App\Models\User::with('transactions')
            ->where('name', 'like', "%$this->search%")
            ->paginate($this->per_page);

        return view('livewire.backend.configuration.user.index', compact('users'))
            ->title(__('User Management'));
    }

    public function clear_search($search = '')
    {
        $this->search = $search;
        $this->resetPage();
    }
}
