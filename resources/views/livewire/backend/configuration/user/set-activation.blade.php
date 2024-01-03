<div>
    @if ($is_show)
        <svg class="w-10 h-10 mt-8 mb-4 text-yellow-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"
            xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
        </svg>
        <div class="my-3">
            <div class="font-bold">
                #{{ $user->id }}
            </div>
            <div class="font-medium">
                {{ $user->name }}
            </div>
            <div class="text-light">
                {{ $user->role_name }}
            </div>
        </div>
        <h3 class="mb-6 dark:text-gray-400">
            {{ __('') }}
        </h3>
        <button wire:click='update_user("{{ \App\Enums\UserStatusType::Active }}")' wire:loading.attr='disabled'
            @class([
                'text-white',
                'bg-green-600',
                'hover:bg-green-800',
                'focus:ring-4',
                'focus:ring-green-300',
                'font-medium',
                'rounded-lg',
                'text-sm',
                'inline-flex',
                'items-center',
                'px-3',
                'py-2.5',
                'text-center',
                'mr-2',
                'dark:focus:ring-green-900',
                'pointer-events-none' => $user->status == \App\Enums\UserStatusType::Active,
                'bg-green-900' => $user->status == \App\Enums\UserStatusType::Active,
            ])>
            {{ __('Active') }}
        </button>
        <button wire:click='update_user("{{ \App\Enums\UserStatusType::Blocked }}")' wire:loading.attr='disabled'
            @class([
                'text-white',
                'bg-red-600',
                'hover:bg-red-800',
                'focus:ring-4',
                'focus:ring-red-300',
                'font-medium',
                'rounded-lg',
                'text-sm',
                'inline-flex',
                'items-center',
                'px-3',
                'py-2.5',
                'text-center',
                'mr-2',
                'dark:focus:ring-red-900',
                'pointer-events-none' =>
                    $user->status == \App\Enums\UserStatusType::Blocked,
                'bg-red-900' => $user->status == \App\Enums\UserStatusType::Blocked,
            ])>
            {{ __('Blocked') }}
        </button>
    @endif
</div>
