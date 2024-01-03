<div class="inline-block">
    <button wire:click='logout'
        class="{{ $class_name ?? 'text-red-500 bg-transparent focus:outline-none hover:underline' }}">
        {{ __('Sign Out') }}
    </button>
</div>
