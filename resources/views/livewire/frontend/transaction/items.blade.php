<div>
    <div class="flex items-center gap-3 px-5 py-2 text-gray-700 bg-yellow-100 border border-yellow-300 rounded-xl mb-7">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
            <path fill="currentColor"
                d="M1 21L12 2l11 19H1Zm3.45-2h15.1L12 6L4.45 19ZM12 18q.425 0 .713-.288T13 17q0-.425-.288-.713T12 16q-.425 0-.713.288T11 17q0 .425.288.713T12 18Zm-1-3h2v-5h-2v5Zm1-2.5Z" />
        </svg>
        <span class="text-light">
            {{ __('You can change the total of items in the cart.') }}
        </span>
    </div>
    <div class="max-h-[70vh] overflow-y-auto">
        @forelse ($carts as $cart)
            <div class="mb-3 overflow-hidden bg-gray-100 rounded-lg">
                <div class="flex flex-wrap items-center overflow-hidden">
                    <div class="flex-grow-0 flex-shrink-0 basis-[90px]">
                        <img class="w-full aspect-square"
                            src="{{ $cart->product->main_image ?? Vite::image('product-default.png') }}"
                            alt="{{ $cart->product->name }} Image">
                    </div>
                    <div
                        class="flex-grow-0 flex-shrink-0 basis-[calc(100%-90px)] overflow-hidden flex lg:items-center justify-between flex-col lg:flex-row px-4 py-3">
                        <a wire:navigate href="{{ route('product.show', $cart->product->slug) }}"
                            class="block overflow-hidden font-semibold text-ellipsis whitespace-nowrap navigate-link">
                            {{ $cart->product->name }}
                            <div class="text-sm font-light">
                                {{ $cart->product->category_name }} -
                                {{ StringHelper::currency($cart->product->weight) }} gram

                            </div>
                        </a>
                        <div class="px-3 mt-3 text-sm text-end">
                            @ {{ StringHelper::currency($cart->product->final_price, true) }}
                            <div class="italic">
                                {{ $cart->qty }} x
                                {{ StringHelper::currency($cart->qty * $cart->product->final_price, true) }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="mb-3">
                {{ __('There are no products you added to your cart') }}
            </div>
        @endforelse
    </div>
    <div class="py-3 border-t text-end border-orange-950">
        <div class="text-gray-700 text-light">
            {{ $carts->sum('qty') }} item
        </div>
        <div class="text-gray-700 text-light">
            {{ StringHelper::currency($carts->sum(fn($q) => $q->qty * $q->product->weight)) }} gram
        </div>
        <div class="text-xl font-bold text-orange-950">
            {{ StringHelper::currency($carts->sum(fn($q) => $q->qty * $q->product->final_price), true) }}
        </div>
    </div>
</div>
