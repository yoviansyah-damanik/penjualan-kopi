<div>
    <div class="px-3 mb-3 bg-white">
        <div class="items-center justify-between block sm:flex md:divide-x md:divide-gray-100 dark:divide-gray-700">
            <div class="relative flex-none max-w-full mt-1 mb-3 lg:w-48 sm:w-64 xl:w-96">
                <input type="text" wire:change="resetPage" wire:model.live='search'
                    class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-orange-950 focus:border-orange-950 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-orange-950 dark:focus:border-orange-950"
                    placeholder="{{ __('Search for products') }}">
                <button wire:click='clear_search'
                    class="absolute text-gray-300 duration-75 -translate-y-1/2 hover:text-gray-700 top-1/2 right-1">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24">
                        <path fill="currentColor"
                            d="m7.825 12l3.875 3.9q.275.275.288.688t-.288.712q-.275.275-.7.275t-.7-.275l-4.6-4.6q-.15-.15-.213-.325T5.425 12q0-.2.063-.375T5.7 11.3l4.6-4.6q.275-.275.688-.287t.712.287q.275.275.275.7t-.275.7L7.825 12Zm6.6 0l3.875 3.9q.275.275.288.688t-.288.712q-.275.275-.7.275t-.7-.275l-4.6-4.6q-.15-.15-.213-.325T12.026 12q0-.2.063-.375t.212-.325l4.6-4.6q.275-.275.688-.287t.712.287q.275.275.275.7t-.275.7L14.425 12Z" />
                    </svg>
                </button>
            </div>
        </div>
    </div>
    <div class="overflow-y-auto max-h-[80vh]">
        @forelse ($products as $product)
            <button class="grid w-full grid-cols-8 gap-3 mb-4 group hover:bg-orange-100/30 dark:hover:bg-orange-700/30"
                wire:click='send_to_transaction("{{ $product->slug }}")'>
                <div class="grid col-span-2 overflow-hidden aspect-square place-items-center">
                    <img class="w-full" src="{{ $product->main_image_path }}" alt="{{ $product->name }} Image">
                </div>
                <div class="col-span-6 text-start">
                    <div class="px-3 py-2 my-auto">
                        <h4
                            class="block overflow-hidden text-base font-bold text-gray-900 lg:text-xl text-ellipsis whitespace-nowrap dark:text-gray-100">
                            {{ $product->name }}
                        </h4>
                        <div class="text-sm font-light dark:text-gray-100">
                            {{ $product->category_name }}
                        </div>
                        <div @class([
                            'flex',
                            'items-end',
                            'justify-between',
                            'dark:text-gray-100',
                            '!justify-end' => !$product->discount,
                        ])>
                            @if ($product->discount)
                                <span
                                    class="relative text-sm before:block before:w-full before:border-t-[3px] before:border-red-300 before:h-3 before:absolute before:bottom-0 before:left-0 before:rotate-[-7deg]">
                                    {{ StringHelper::currency($product->price, true) }}
                                </span>
                                <div class="text-xl font-bold text-orange-900 dark:text-orange-300">
                                    {{ StringHelper::currency($product->final_price, true) }}
                                </div>
                            @else
                                <div class="text-xl font-bold text-orange-900 dark:text-orange-300">
                                    {{ StringHelper::currency($product->price, true) }}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </button>
        @empty
            <div class="text-center">
                {{ __('No data found.') }}
            </div>
        @endforelse
    </div>
</div>
