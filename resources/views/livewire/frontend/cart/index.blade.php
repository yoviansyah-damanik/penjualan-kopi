<div class="relative">
    <button id="cart" class="relative bg-transparent focus:outline-none"
        wire:click="$set('is_show',{{ $is_show ? 0 : 1 }})">
        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24">
            <path fill="currentColor"
                d="M7 22q-.825 0-1.413-.588T5 20q0-.825.588-1.413T7 18q.825 0 1.413.588T9 20q0 .825-.588 1.413T7 22Zm10 0q-.825 0-1.413-.588T15 20q0-.825.588-1.413T17 18q.825 0 1.413.588T19 20q0 .825-.588 1.413T17 22ZM6.15 6l2.4 5h7l2.75-5H6.15ZM5.2 4h14.75q.575 0 .875.513t.025 1.037l-3.55 6.4q-.275.5-.738.775T15.55 13H8.1L7 15h12v2H7q-1.125 0-1.7-.988t-.05-1.962L6.6 11.6L3 4H1V2h3.25l.95 2Zm3.35 7h7h-7Z" />
        </svg>
        <span class="absolute -right-1/4 text-sm text-white bg-red-500 -top-1/4 w-[22px] aspect-square rounded-full">
            {{ $carts->sum('qty') }}
        </span>
    </button>

    {{-- CART MODAL --}}
    <div id="cartModal"
        class="@if (!$is_show) hidden @else fixed @endif -translate-x-1/2 top-[100px] lg:top-[120px] left-1/2 w-[100vw] max-w-[calc(100vw-1rem)] lg:max-w-[900px] p-6 rounded-xl min-h-[calc(100vh-140px)] lg:min-h-[600px] bg-[#1a120b]/90"
        data-modal="true">
        <div class="flex items-center justify-between">
            <h5 class="text-xl font-bold ">
                {{ __('Cart') }}
            </h5>
            <button id="closeModal" class=" focus:outline-none" wire:click="$set('is_show',false)">
                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24">
                    <path fill="currentColor"
                        d="M6.4 19L5 17.6l5.6-5.6L5 6.4L6.4 5l5.6 5.6L17.6 5L19 6.4L13.4 12l5.6 5.6l-1.4 1.4l-5.6-5.6L6.4 19Z" />
                </svg>
            </button>
        </div>
        <div class="mt-7 max-h-[calc(50vh+40px)] lg:max-h-[450px] overflow-y-auto overflow-x-hidden">
            <div class="flex flex-wrap">
                @forelse ($carts as $cart)
                    <livewire:frontend.cart.item :$cart :key="$cart->id" lazy='false' />
                @empty
                    <div class="text-center">
                        {{ __('There are no products you added to your cart') }}
                    </div>
                @endforelse
            </div>
        </div>
        <div
            class="absolute lg:flex-row flex flex-col lg:items-baseline lg:justify-between bottom-0 left-0 right-0 w-[95%] mx-auto mb-5">
            <div class="text-3xl font-bold text-red-500 text-end lg:text-start lg:mb-0">
                {{ StringHelper::currency($carts->sum(fn($q) => $q->product->is_ready == true ? $q->product->final_price : 0), true) }}
            </div>

            <a href="{{ route('transaction') }}" wire:navigate
                class="flex items-center justify-center gap-3 py-1 text-center bg-red-500 rounded-md px-9">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 14 14">
                    <g fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round">
                        <path color="currentColor"
                            d="M6.5 11h1M10 5V3m2-1.25A1.25 1.25 0 0 1 10.75 3h-1.5a1.25 1.25 0 0 1 0-2.5h1.5A1.25 1.25 0 0 1 12 1.75ZM5.5 5V1.5h-3V5" />
                        <rect width="13" height="5" x=".5" y="8.5" rx="1" />
                        <path d="M12.5 8.5V6a1 1 0 0 0-1-1h-9a1 1 0 0 0-1 1v2.5" />
                    </g>
                </svg>
                {{ __('Check Out') }}
            </a>
        </div>
    </div>
</div>
