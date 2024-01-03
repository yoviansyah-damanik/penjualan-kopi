<div @class([
    'w-full',
    'px-4',
    'bg-orange-100',
    'rounded-xl',
    'py-7',
    'grayscale' => !$product->is_ready,
])>
    <div class="mb-3 text-center">
        {{ __('Stock') }}: <span @class([
            'text-green-600' => $product->is_ready,
            'text-red-600' => !$product->is_ready,
        ])>
            {{ $product->is_ready ? __('Available') : __('Unavailable') }}
        </span>
    </div>
    <div class="mb-5 text-2xl font-extrabold text-center">
        {{ StringHelper::currency($product->price, true) }}
    </div>
    <div class="flex flex-wrap justify-center gap-1 py-3 mt-3 bg-white">
        <button wire:click='decrement' wire:loading.attr='disabled' wire:target='increment,decrement,delete'
            class="focus:outline-none transition duration-150 bg-orange-500 rounded-md w-[30px] flex justify-center items-center aspect-square hover:bg-orange-950">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24">
                <path fill="#fff" d="M4 13v-2h16v2H4Z" />
            </svg>
        </button>
        <span class="px-3 w-[80px] text-center">
            {{ $amount }}
        </span>
        <button wire:click='increment' wire:loading.attr='disabled' wire:target='increment,decrement,delete'
            class="focus:outline-none transition duration-150 bg-orange-500 rounded-md w-[30px] flex justify-center items-center aspect-square hover:bg-orange-950">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24">
                <path fill="#fff" d="M11 13H5v-2h6V5h2v6h6v2h-6v6h-2v-6Z" />
            </svg>
        </button>
    </div>
    @guest
        <a href="{{ route('login') }}"
            class="mt-4 bg-[#991b1b] text-white w-full py-2 px-5 flex items-center justify-center gap-2 hover:bg-[#3C2A21] transition duration-100">
            <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 576 512">
                <path fill="currentColor"
                    d="M0 24C0 10.7 10.7 0 24 0H69.5c22 0 41.5 12.8 50.6 32h411c26.3 0 45.5 25 38.6 50.4l-41 152.3c-8.5 31.4-37 53.3-69.5 53.3H170.7l5.4 28.5c2.2 11.3 12.1 19.5 23.6 19.5H488c13.3 0 24 10.7 24 24s-10.7 24-24 24H199.7c-34.6 0-64.3-24.6-70.7-58.5L77.4 54.5c-.7-3.8-4-6.5-7.9-6.5H24C10.7 48 0 37.3 0 24zM128 464a48 48 0 1 1 96 0 48 48 0 1 1 -96 0zm336-48a48 48 0 1 1 0 96 48 48 0 1 1 0-96z" />
            </svg>
            {{ __('Add to cart') }}
        </a>
    @else
        <button wire:click="$dispatch('add_to_cart',{product:'{{ $product->slug }}', amount:{{ $amount }}})"
            wire:loading.attr='disabled' wire:target='add_to_cart'
            class="mt-4 bg-[#991b1b] rounded-lg text-white w-full py-2 px-5 flex items-center justify-center gap-2 hover:bg-[#3C2A21] transition duration-100">
            <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 576 512">
                <path fill="currentColor"
                    d="M0 24C0 10.7 10.7 0 24 0H69.5c22 0 41.5 12.8 50.6 32h411c26.3 0 45.5 25 38.6 50.4l-41 152.3c-8.5 31.4-37 53.3-69.5 53.3H170.7l5.4 28.5c2.2 11.3 12.1 19.5 23.6 19.5H488c13.3 0 24 10.7 24 24s-10.7 24-24 24H199.7c-34.6 0-64.3-24.6-70.7-58.5L77.4 54.5c-.7-3.8-4-6.5-7.9-6.5H24C10.7 48 0 37.3 0 24zM128 464a48 48 0 1 1 96 0 48 48 0 1 1 -96 0zm336-48a48 48 0 1 1 0 96 48 48 0 1 1 0-96z" />
            </svg>
            {{ __('Add to cart') }}
        </button>
    @endguest
</div>
