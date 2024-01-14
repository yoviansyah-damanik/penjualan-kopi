<div class="overflow-y-auto max-h-[80vh]">
    @foreach ($products as $product)
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
    @endforeach
</div>
