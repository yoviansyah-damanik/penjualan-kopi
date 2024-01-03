<div class="min-h-[60vh]">
    <div class="container py-12">
        <h4 class="mb-6 text-3xl font-bold wow fadeIn">
            {{ __('Products') }}
        </h4>
        <div class="mb-6">
            <button wire:click='set_category("all")' @class([
                'mb-1',
                'py-2',
                'px-5',
                'text-white',
                'focus:outline-none',
                'bg-[#991b1b]',
                'rounded-lg',
                '!bg-[#3C2A21]' => $category == 'all',
                'cursor-not-allowed' => $category == 'all',
            ]) @disabled($category == 'all')>
                {{ __('All') }}
            </button>
            <button wire:click='set_category("uncategorized")' @class([
                'mb-1',
                'py-2',
                'px-5',
                'text-white',
                'focus:outline-none',
                'bg-[#991b1b]',
                'rounded-lg',
                '!bg-[#3C2A21]' => $category == 'uncategorized',
                'cursor-not-allowed' => $category == 'uncategorized',
            ]) @disabled($category == 'uncategorized')>
                {{ __('Uncategorized') }}
            </button>
            @foreach ($categories as $item)
                <button wire:click='set_category("{{ $item->slug }}")' @class([
                    'mb-1',
                    'py-2',
                    'px-5',
                    'text-white',
                    'focus:outline-none',
                    'bg-[#991b1b]',
                    '!bg-[#3C2A21]' => $category == $item->slug,
                    'cursor-not-allowed' => $category == $item->slug,
                    'rounded-lg',
                ])
                    @disabled($category == $item->slug)>
                    {{ $item->name }}
                </button>
            @endforeach
        </div>
        <div class="mb-6 wow fadeIn">
            <input type="text" placeholder="{{ __('Search') }}" wire:model.live='search'
                class="focus:shadow-primary-outline text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding p-3 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-orange-950 focus:outline-none" />
        </div>
        <div class="justify-center row">
            @forelse ($products as $product)
                <div class="w-1/2 lg:w-1/4">
                    <div class="relative px-2 py-4 mx-2 mb-4 overflow-hidden text-center duration-300 rounded-lg group lg:mt-6 lg:mx-3 lg:px-3 lg:py-6 wow fadeIn"
                        data-wow-duration="1s" data-wow-delay="0.2s">
                        <img @class([
                            'w-64',
                            'mx-auto',
                            'aspect-square',
                            'grayscale' => !$product->is_ready,
                        ]) src="{{ $product->main_image_path }}"
                            alt="{{ $product->name }} Image">
                        <div class="mt-4">
                            <h4
                                class="block overflow-hidden text-base font-bold text-gray-900 lg:text-xl text-ellipsis whitespace-nowrap">
                                {{ $product->name }}
                            </h4>
                            <div class="mb-4 text-sm font-light">
                                {{ $product->category_name }}
                            </div>
                            <p class="text-sm line-clamp-3 lg:text-base">
                                {{ $product->excerpt }}
                            </p>
                            <div
                                class="absolute inset-0 flex items-center justify-center gap-3 transition duration-300 opacity-0 group-hover:opacity-100 group-hover:z-10 -z-10 bg-orange-950/10">
                                @guest
                                    <a href="{{ route('login') }}"
                                        class="rounded-lg bg-[#991b1b] text-white grid place-items-center w-14 h-9 hover:bg-[#3C2A21] transition duration-100">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" viewBox="0 0 24 24">
                                            <path fill="currentColor"
                                                d="M11 9V6H8V4h3V1h2v3h3v2h-3v3h-2ZM7 22q-.825 0-1.413-.588T5 20q0-.825.588-1.413T7 18q.825 0 1.413.588T9 20q0 .825-.588 1.413T7 22Zm10 0q-.825 0-1.413-.588T15 20q0-.825.588-1.413T17 18q.825 0 1.413.588T19 20q0 .825-.588 1.413T17 22ZM1 4V2h3.275l4.25 9h7l3.9-7H21.7l-4.4 7.95q-.275.5-.738.775T15.55 13H8.1L7 15h12v2H7q-1.125 0-1.713-.975T5.25 14.05L6.6 11.6L3 4H1Z" />
                                        </svg>
                                    </a>
                                @else
                                    <button wire:click="$dispatch('add_to_cart',{product:'{{ $product->slug }}'})"
                                        wire:loading.attr='disabled' wire:target='add_to_cart'
                                        class="bg-[#991b1b] rounded-lg text-white grid place-items-center w-14 h-9 hover:bg-[#3C2A21] transition duration-100">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" viewBox="0 0 24 24">
                                            <path fill="currentColor"
                                                d="M11 9V6H8V4h3V1h2v3h3v2h-3v3h-2ZM7 22q-.825 0-1.413-.588T5 20q0-.825.588-1.413T7 18q.825 0 1.413.588T9 20q0 .825-.588 1.413T7 22Zm10 0q-.825 0-1.413-.588T15 20q0-.825.588-1.413T17 18q.825 0 1.413.588T19 20q0 .825-.588 1.413T17 22ZM1 4V2h3.275l4.25 9h7l3.9-7H21.7l-4.4 7.95q-.275.5-.738.775T15.55 13H8.1L7 15h12v2H7q-1.125 0-1.713-.975T5.25 14.05L6.6 11.6L3 4H1Z" />
                                        </svg>
                                    </button>
                                @endguest
                                <a href="{{ route('product.show', $product->slug) }}"
                                    class="grid text-white transition duration-100 rounded-lg h-9 place-items-center w-14 bg-cyan-600 hover:bg-cyan-800">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" viewBox="0 0 24 24">
                                        <path fill="currentColor"
                                            d="M12 4.5C7 4.5 2.7 7.6 1 12c1.7 4.4 6 7.5 11 7.5h1.1c-.1-.3-.1-.6-.1-1s0-.7.1-1.1c-.4 0-.7.1-1.1.1c-3.8 0-7.2-2.1-8.8-5.5c1.6-3.4 5-5.5 8.8-5.5s7.2 2.1 8.8 5.5c-.1.2-.3.4-.4.7c.7.2 1.3.4 1.9.8c.3-.5.5-1 .7-1.5c-1.7-4.4-6-7.5-11-7.5M12 9c-1.7 0-3 1.3-3 3s1.3 3 3 3s3-1.3 3-3s-1.3-3-3-3m7 12v-2h-4v-2h4v-2l3 3z" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- <div @class([
                    'flex-grow-0',
                    'flex-shrink-0',
                    'mb-3',
                    'overflow-hidden',
                    'basis-1/2',
                    'lg:basis-1/4',
                    'wow',
                    'fadeIn',
                ]) data-wow-delay="{{ 0.2 * (($loop->iteration - 1) % 4) }}s">
                    <div class="mx-1 overflow-hidden border rounded-xl">
                        <img class="w-full" src="{{ $product->main_image_path ?? Vite::image('product-default.png') }}"
                            alt="{{ $product->name }} Image">
                        <div class="p-3 lg:p-4">
                            <a wire:navigate href="{{ route('product.show', $product->slug) }}"
                                class="block overflow-hidden font-semibold text-ellipsis whitespace-nowrap">
                                {{ $product->name }}
                            </a>
                            <div
                                class="overflow-hidden italic font-light text-gray-500 text-ellipsis whitespace-nowrap">
                                {{ $product->category_name }}
                            </div>

                            <div class="text-lg lg:text-2xl text-end text-[#991b1b] font-bold mt-3">
                                {{ StringHelper::currency($product->price, true) }}
                            </div>

                            @guest
                                <a href="{{ route('login') }}"
                                    class="mt-4 bg-[#991b1b] text-white w-full py-2 px-5 flex items-center justify-center gap-2 hover:bg-[#3C2A21] transition duration-100">
                                    <svg xmlns="http://www.w3.org/2000/svg" height="1em"
                                        viewBox="0 0 576 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                                        <path fill="currentColor"
                                            d="M0 24C0 10.7 10.7 0 24 0H69.5c22 0 41.5 12.8 50.6 32h411c26.3 0 45.5 25 38.6 50.4l-41 152.3c-8.5 31.4-37 53.3-69.5 53.3H170.7l5.4 28.5c2.2 11.3 12.1 19.5 23.6 19.5H488c13.3 0 24 10.7 24 24s-10.7 24-24 24H199.7c-34.6 0-64.3-24.6-70.7-58.5L77.4 54.5c-.7-3.8-4-6.5-7.9-6.5H24C10.7 48 0 37.3 0 24zM128 464a48 48 0 1 1 96 0 48 48 0 1 1 -96 0zm336-48a48 48 0 1 1 0 96 48 48 0 1 1 0-96z" />
                                    </svg>
                                    <span class="hidden lg:!inline-block">
                                        {{ __('Add to cart') }}
                                    </span>
                                </a>
                            @else
                                <button wire:click="$dispatch('add_to_cart',{product:'{{ $product->slug }}'})"
                                    wire:loading.attr='disabled' wire:target='add_to_cart'
                                    class="mt-4 bg-[#991b1b] rounded-lg text-white w-full py-2 px-5 flex items-center justify-center gap-2 hover:bg-[#3C2A21] transition duration-100">
                                    <svg xmlns="http://www.w3.org/2000/svg" height="1em"
                                        viewBox="0 0 576 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                                        <path fill="currentColor"
                                            d="M0 24C0 10.7 10.7 0 24 0H69.5c22 0 41.5 12.8 50.6 32h411c26.3 0 45.5 25 38.6 50.4l-41 152.3c-8.5 31.4-37 53.3-69.5 53.3H170.7l5.4 28.5c2.2 11.3 12.1 19.5 23.6 19.5H488c13.3 0 24 10.7 24 24s-10.7 24-24 24H199.7c-34.6 0-64.3-24.6-70.7-58.5L77.4 54.5c-.7-3.8-4-6.5-7.9-6.5H24C10.7 48 0 37.3 0 24zM128 464a48 48 0 1 1 96 0 48 48 0 1 1 -96 0zm336-48a48 48 0 1 1 0 96 48 48 0 1 1 0-96z" />
                                    </svg>
                                    <span class="hidden lg:!inline-block">
                                        {{ __('Add to cart') }}
                                    </span>
                                </button>
                            @endguest
                        </div>
                    </div>
                </div> --}}

            @empty
                <div class="text-center">
                    {{ __('No data found.') }}
                </div>
            @endforelse

        </div>
        @if ($products->hasPages())
            <div class="block mt-6">
                {{ $products->links() }}
            </div>
        @endif
    </div>
</div>
