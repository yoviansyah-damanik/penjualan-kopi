<div class="py-5 bg-white">
    <h4 class="px-3 font-bold text-center uppercase">
        {{ __('Income Report') }}
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
                                <th scope="col" class="p-4 text-xs font-medium text-gray-500 uppercase border">
                                    {{ __('Sales Income') }} (Rp)
                                </th>
                                <th scope="col" class="p-4 text-xs font-medium text-gray-500 uppercase border">
                                    {{ __('Cost') }} (Rp)
                                </th>
                                <th scope="col" class="p-4 text-xs font-medium text-gray-500 uppercase border">
                                    {{ __('Net') }} (Rp)
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
                                        class="px-3 py-2 text-sm font-normal text-gray-500 align-top border border-s-0 whitespace-nowrap text-end">
                                        {{ StringHelper::currency(collect($product['results'][0]['results'])->sum('sales_income')) }}
                                    </td>
                                    <td
                                        class="px-3 py-2 text-sm font-normal text-gray-500 align-top border border-s-0 whitespace-nowrap text-end">
                                        {{ StringHelper::currency(collect($product['results'][0]['results'])->sum('cost')) }}
                                    </td>
                                    <td
                                        class="px-3 py-2 text-sm font-normal text-gray-500 align-top border border-s-0 whitespace-nowrap text-end">
                                        {{ StringHelper::currency(collect($product['results'][0]['results'])->sum(fn($q) => $q['sales_income'] - $q['cost'])) }}
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
                                    {{ __('Total') }}
                                </td>
                                <td class="px-3 py-2 border text-end">
                                    {{ StringHelper::currency($products['total_sales']['sales_income']) }}
                                </td>
                                <td class="px-3 py-2 border text-end">
                                    {{ StringHelper::currency($products['total_sales']['cost']) }}
                                </td>
                                <td class="px-3 py-2 border text-end">
                                    {{ StringHelper::currency($products['total_sales']['net']) }}
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
                <h5 class="text-xl font-bold">{{ __('Highest Income Sales') }}</h5>
            </div>
            <div class="col-span-1 p-4 border">
                @forelse ($products['highest_income_products']['products'] as $product)
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
                            {{ __('Sales Income') }}:
                            {{ StringHelper::currency($product['total']['sales_income'], true) }} |
                            {{ __('Cost') }}:
                            {{ StringHelper::currency($product['total']['cost'], true) }} |
                            {{ __('Total Net') }}:
                            {{ StringHelper::currency($product['total']['net'], true) }}
                        </div>
                    </div>
                @empty
                    {{ __('No :data found.', ['data' => __('product')]) }}
                @endforelse
            </div>
        </div>
    </div>
</div>
