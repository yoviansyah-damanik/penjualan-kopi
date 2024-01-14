<div class="box-border flex-grow-0 flex-shrink-0 px-2 mb-3 basis-full lg:basis-1/2">
    @if ($is_show)
        <div @class([
            'overflow-hidden',
            'rounded-lg',
            'bg-orange-900/60',
            'grayscale' => !$cart->product->is_ready,
        ])>
            <div class="flex flex-wrap items-center overflow-hidden">
                <div class="flex-grow-0 flex-shrink-0 basis-[90px]">
                    <img class="w-full aspect-square"
                        src="{{ $cart->product->main_image ?? Vite::image('product-default.png') }}"
                        alt="{{ $cart->product->name }} Image">
                </div>
                <div
                    class="flex-grow-0 flex-shrink-0 basis-[calc(100%-90px)] overflow-hidden flex lg:items-center justify-between flex-col lg:flex-row px-4 py-3 gap-1">
                    <a wire:navigate href="{{ route('product.show', $cart->product->slug) }}"
                        class="block overflow-hidden font-semibold text-ellipsis whitespace-nowrap navigate-link">
                        {{ $cart->product->name }}
                        <div class="text-sm font-light">
                            {{ StringHelper::currency($cart->product->final_price, true) }}
                        </div>
                    </a>
                    <div @class([
                        'flex',
                        'flex-wrap',
                        'items-center',
                        'gap-1',
                        'lg:basis-32',
                        'justify-end',
                    ])>
                        @if ($cart->product->is_ready)
                            <button wire:click='decrement' wire:loading.attr='disabled'
                                wire:target='increment,decrement,delete'
                                class="focus:outline-none transition duration-150 bg-orange-500 rounded-md h-[25px] flex justify-center items-center aspect-square hover:bg-orange-950">
                                <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15"
                                    viewBox="0 0 24 24">
                                    <path fill="currentColor" d="M4 13v-2h16v2H4Z" />
                                </svg>
                            </button>
                            <span class="px-1 text-sm">
                                {{ $qty }}
                            </span>
                            <button wire:click='increment' wire:loading.attr='disabled'
                                wire:target='increment,decrement,delete'
                                class="focus:outline-none transition duration-150 bg-orange-500 rounded-md h-[25px] flex justify-center items-center aspect-square hover:bg-orange-950">
                                <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15"
                                    viewBox="0 0 24 24">
                                    <path fill="currentColor" d="M11 13H5v-2h6V5h2v6h6v2h-6v6h-2v-6Z" />
                                </svg>
                            </button>
                        @endif
                        <button wire:click='delete' wire:loading.attr='disabled'
                            wire:target='increment,decrement,delete'
                            class="focus:outline-none transition duration-150 bg-red-500 rounded-md w-[25px] flex justify-center items-center aspect-square hover:bg-red-950">
                            <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24">
                                <path fill="currentColor"
                                    d="M7 21q-.825 0-1.413-.588T5 19V6H4V4h5V3h6v1h5v2h-1v13q0 .825-.588 1.413T17 21H7ZM17 6H7v13h10V6ZM9 17h2V8H9v9Zm4 0h2V8h-2v9ZM7 6v13V6Z" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="flex items-center gap-2 m-auto">
            <svg class="w-5 h-5 mr-3 -ml-1 text-white animate-spin" xmlns="http://www.w3.org/2000/svg" fill="none"
                viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4">
                </circle>
                <path class="opacity-75" fill="currentColor"
                    d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                </path>
            </svg>
            {{ __('Loading') }}...
        </div>
    @endif
</div>
