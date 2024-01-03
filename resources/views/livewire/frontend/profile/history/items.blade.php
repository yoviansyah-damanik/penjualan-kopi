<div>
    @forelse ($transactions as $transaction)
        <livewire:frontend.profile.history.item :$transaction lazy />
    @empty

        {{ __('No data found.') }}
    @endforelse

    <div class="mt-7">
        {{ $transactions->links() }}
    </div>
</div>
