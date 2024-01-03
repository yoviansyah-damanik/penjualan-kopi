<div class="py-5 bg-white">
    <h4 class="px-3 font-bold text-center uppercase">
        {{ __('Sales Report') }}
        <br />
        {{ config('app.name') }}
        <br />
        {{ Carbon::createFromFormat('m', $month)->translatedFormat('F') . ' ' . $year }}
    </h4>

    <div class="mt-7">
        <div class="overflow-x-auto overflow-y-auto max-h-[60vh]">
            <div class="inline-block min-w-full align-middle">
                <div class="overflow-hidden shadow">
                    <table class="min-w-full divide-y divide-gray-200 table-fixed dark:divide-gray-600">
                        <thead class="text-center bg-gray-100">
                            <tr class="text-center">
                                <th scope="col" class="w-12 p-4 text-xs font-medium text-gray-500 uppercase border">
                                    #
                                </th>
                                <th scope="col" class="p-4 text-xs font-medium text-gray-500 uppercase border">
                                    {{ __(':name Name', ['name' => __('Product')]) }}
                                </th>
                                <th scope="col" class="w-32 p-4 text-xs font-medium text-gray-500 uppercase border">
                                    {{ __('Sold') }}
                                </th>
                                <th colspan=2 scope="col"
                                    class="w-40 p-4 text-xs font-medium text-gray-500 uppercase border">
                                    {{ __('Sales Income') }}
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200 ">
                            @forelse ($products['results'] as $product)
                                <tr>
                                    <td
                                        class="px-3 py-2 text-sm font-normal text-center text-gray-500 align-top border whitespace-nowrap">
                                        {{ $loop->iteration }}
                                    </td>
                                    <td
                                        class="px-3 py-2 text-sm font-normal text-gray-500 align-top border whitespace-nowrap">
                                        <div class="text-base font-semibold text-gray-900 underline dark:text-white">
                                            #{{ $product['id'] }}
                                        </div>
                                        <div class="text-base font-semibold text-gray-900 dark:text-white">
                                            {{ $product['name'] }}
                                        </div>
                                        <div class="text-sm font-normal text-gray-500 dark:text-gray-400">
                                            {{ $product['category_name'] }}
                                        </div>
                                    </td>
                                    <td
                                        class="px-3 py-2 text-sm font-normal text-center text-gray-500 align-top border whitespace-nowrap">
                                        {{ StringHelper::currency(collect($product['results'][0]['results'])->sum('sold')) }}
                                    </td>
                                    <td class="px-3 py-2 text-sm font-normal text-gray-500 align-top whitespace-wrap">
                                        Rp.
                                    </td>
                                    <td
                                        class="px-3 py-2 text-sm font-normal text-gray-500 align-top border border-s-0 whitespace-nowrap text-end">
                                        {{ StringHelper::currency(collect($product['results'][0]['results'])->sum('sales_income')) }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-3 py-2 text-center">
                                        <span class="text-gray-700">
                                            {{ __('No data found.') }}
                                        </span>
                                    </td>
                                </tr>
                            @endforelse
                            <tr class="font-bold">
                                <td colspan="2" class="px-3 py-2 text-center border">
                                    {{ __('Total Sales') }}
                                </td>
                                <td class="px-3 py-2 text-center border">
                                    {{ StringHelper::currency($products['total_sales']['sold']) }}
                                </td>
                                <td class="px-3 py-2 align-top border-b whitespace-wrap">
                                    Rp.
                                </td>
                                <td class="px-3 py-2 align-top border text-end whitespace-wrap border-s-0">
                                    {{ StringHelper::currency($products['total_sales']['sales_income']) }}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="px-3 mt-7">
        <div class="grid grid-cols-2">
            <div class="col-span-1 p-4 border">
                <h5 class="text-xl font-bold">{{ __('Best Selling Product') }}</h5>
            </div>
            <div class="col-span-1 p-4 border">
                @forelse ($products['popular_products'] as $product)
                    <div @class([
                        'pb-3' => !$loop->last,
                        'border-b' => !$loop->last,
                        'mt-3' => !$loop->first,
                    ])>
                        <div class="text-base font-semibold text-gray-900 underline dark:text-white">
                            #{{ $product['id'] }}
                        </div>
                        <div class="text-base font-semibold text-gray-900 dark:text-white">
                            {{ $product['name'] }}
                        </div>
                        <div class="text-sm font-normal text-gray-500 dark:text-gray-400">
                            {{ $product['category_name'] }}
                        </div>
                        <div class="text-sm italic">
                            {{ __('Sold') }}:
                            {{ StringHelper::currency($product['total']['sold']) }}
                        </div>
                    </div>
                @empty
                    {{ __('No :data found.', ['data' => __('product')]) }}
                @endforelse
            </div>
        </div>
    </div>
</div>
