<div>
    @foreach (\App\Enums\TransactionStatusType::getKeys() as $item)
        <button @class([
            'w-full',
            'py-2',
            'px-3',
            'rounded-lg',
            'text-center',
            'bg-orange-950' => $filter != 'all' && $item == $filter,
            'text-white' => $filter != 'all' && $item == $filter,
            'pointer-events-none' => $filter != 'all' && $item == $filter,
            'hover:bg-orange-950/10',
            'focus:outline-none',
        ]) wire:click="set_filter('{{ $item }}')" wire:loading.attr='disabled'>
            {{ __(Str::headline($item)) }}
        </button>
    @endforeach
    <button @class([
        'w-full',
        'py-2',
        'px-3',
        'rounded-lg',
        'text-center',
        'bg-orange-950' => $filter == 'all',
        'text-white' => $filter == 'all',
        'pointer-events-none' => $filter == 'all',
        'hover:bg-orange-950/10',
        'focus:outline-none',
    ]) wire:click="set_filter('all')" wire:loading.attr='disabled'>
        {{ __('All') }}
    </button>
</div>
