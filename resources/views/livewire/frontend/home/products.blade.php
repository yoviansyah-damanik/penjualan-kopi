<section id="products" class="services-area pt-120">
    <div class="container">
        <div class="justify-center row">
            <div class="w-full lg:w-2/3">
                <div class="pb-10 text-center section-title">
                    <div class="m-auto line"></div>
                    <h3 class="title">
                        {{ __('Selected coffee beans') }},
                        <span>
                            {{ __('Delicious coffee that you can enjoy every day!') }}
                        </span>
                    </h3>
                </div>
            </div>
        </div>
        <div class="justify-start row">
            @forelse ($products as $product)
                <div class="w-1/2 lg:w-1/4">
                    <div class="mx-2 mb-3 duration-300 bg-white group lg:mt-3 lg:mx-3 wow fadeIn" data-wow-duration="1s"
                        data-wow-delay="0.2s">
                        <div
                            class="relative flex items-center justify-center w-full overflow-hidden rounded-lg aspect-square">
                            <img @class([
                                'duration-300',
                                'group-hover:scale-125',
                                'w-full',
                                'grayscale' => !$product->is_ready,
                            ]) src="{{ $product->main_image_path }}"
                                alt="{{ $product->name }} Image">

                            <div
                                class="absolute bg-[#991b1b]/30 py-4 inset-0 flex items-center justify-center gap-3 transition duration-300 opacity-0 group-hover:opacity-100 z-10">
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
                        <div class="pb-4 mt-3">
                            <h4
                                class="block px-3 overflow-hidden text-base font-bold text-gray-900 lg:text-xl text-ellipsis whitespace-nowrap">
                                {{ $product->name }}
                            </h4>
                            <div class="px-3 mb-4 text-sm font-light">
                                {{ $product->category_name }}
                            </div>
                            <div class="mb-4 text-sm line-clamp-3 lg:text-base min-h-24">
                                <div class="px-3 text-gray-500">
                                    {{ $product->excerpt }}
                                </div>
                            </div>
                            <div @class([
                                'flex',
                                'px-3',
                                'items-end',
                                'lg:justify-between',
                                'justify-end',
                                '!justify-end' => !$product->discount,
                            ])>
                                @if ($product->discount)
                                    <span
                                        class="hidden lg:block relative text-sm before:block before:w-full before:border-t-[3px] before:border-red-300 before:h-3 before:absolute before:bottom-0 before:left-0 before:rotate-[-7deg]">
                                        {{ StringHelper::currency($product->price, true) }}
                                    </span>
                                    <div class="text-xl font-bold text-orange-900">
                                        {{ StringHelper::currency($product->final_price, true) }}
                                    </div>
                                @else
                                    <div class="text-xl font-bold text-orange-900">
                                        {{ StringHelper::currency($product->price, true) }}
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="text-center">
                    {{ __('No data found.') }}
                </div>
            @endforelse
        </div>
        <div class="mt-16 text-center lg:mt-20">
            <a href="{{ route('product') }}" wire:navigate class="main-btn gradient-btn">{{ __('Show more') }}</a>
        </div>
    </div>
</section>
