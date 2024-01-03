<div class="py-5 bg-white">
    <h4 class="px-3 font-bold text-center uppercase">
        {{ __('Sales Report') }}
        <br />
        {{ config('app.name') }}
        <br />
        {{ Carbon::createFromFormat('Y', $year)->startOfYear()->translatedFormat('F') .' - ' .Carbon::createFromFormat('Y', $year)->endOfYear()->translatedFormat('F') .' ' .$year }}
    </h4>

    <div class="mt-7">
        <div class="overflow-x-auto overflow-y-auto max-h-[60vh]">
            <div class="inline-block min-w-full align-middle">
                <div class="overflow-hidden shadow">
                    <table class="min-w-full divide-y divide-gray-200 table-fixed dark:divide-gray-600">
                        <thead class="text-center bg-gray-100">
                            <tr>
                                <th scope="col" rowspan="2"
                                    class="w-12 p-4 font-medium text-gray-500 uppercase border">
                                    #
                                </th>
                                <th scope="col" rowspan="2"
                                    class="p-4 font-medium text-gray-500 uppercase border">
                                    {{ __(':name Name', ['name' => __('Product')]) }}
                                </th>
                                <th colspan="12" scope="col"
                                    class="p-4 font-medium text-gray-500 uppercase border">
                                    {{ __('Sold') }}
                                </th>
                                <th colspan="2" scope="col" rowspan="2"
                                    class="p-4 font-medium text-gray-500 uppercase border">
                                    {{ __('Total Sales') }}
                                </th>
                            </tr>
                            <tr>
                                @foreach (range(1, 12) as $y)
                                    <th class="p-4 font-medium text-gray-500 uppercase border">
                                        {{ Carbon::createFromFormat('m', $y)->translatedFormat('M') }}
                                    </th>
                                @endforeach
                            </tr>
                        </thead>

                        <tbody class="bg-white divide-y divide-gray-200 ">
                            @forelse ($products['results'] as $product)
                                <tr>
                                    <td
                                        class="px-3 py-2 font-normal text-center text-gray-500 align-top border whitespace-nowrap">
                                        {{ $loop->iteration }}
                                    </td>
                                    <td class="px-3 py-2 font-normal text-gray-500 align-top border whitespace-nowrap">
                                        <div class="font-semibold text-gray-900 underline dark:text-white">
                                            #{{ $product['id'] }}
                                        </div>
                                        <div class="font-semibold text-gray-900 dark:text-white">
                                            {{ $product['name'] }}
                                        </div>
                                        <div class="font-normal text-gray-500 dark:text-gray-400">
                                            {{ $product['category_name'] }}
                                        </div>
                                    </td>
                                    @foreach (range(1, 12) as $y)
                                        <td
                                            class="px-3 py-2 font-normal text-center text-gray-500 align-top border whitespace-nowrap">
                                            {{ StringHelper::currency($product['results'][$y - 1]['total']['sold']) }}
                                        </td>
                                    @endforeach
                                    <td
                                        class="px-3 py-2 font-bold text-center text-gray-500 align-top border whitespace-nowrap">
                                        {{ StringHelper::currency(collect($product['results'])->sum('total.sold')) }}
                                    </td>
                                    <td
                                        class="px-3 py-2 font-bold text-gray-500 align-top border border-s-0 whitespace-nowrap text-end">
                                        {{ StringHelper::currency(collect($product['results'])->sum('total.sales_income'), true) }}
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
                                <td colspan=2 class="px-3 py-2 font-bold text-center border">
                                    {{ __('Total Sales') }}
                                </td>
                                @foreach (range(1, 12) as $y)
                                    <td class="px-3 py-2 text-center border">
                                        {{ StringHelper::currency(collect($products['results'])->sum('results.' . $y - 1 . '.total.sold')) }}
                                    </td>
                                @endforeach
                                <td class="px-3 py-2 text-center border">
                                    {{ StringHelper::currency(collect($products['results'])->sum(fn($q) => collect($q['results'])->sum('total.sold'))) }}
                                </td>
                                <td class="px-3 py-2 align-top border text-end whitespace-wrap border-s-0">
                                    {{ StringHelper::currency(collect($products['results'])->sum(fn($q) => collect($q['results'])->sum('total.sales_income')), true) }}
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
