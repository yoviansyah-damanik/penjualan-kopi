<!DOCTYPE html>
<html>

<head>
    <style>
        html {
            font-size: 10pt;
            font-family: Arial, Helvetica, sans-serif;
            margin: 1cm;
        }

        h5 {
            font-size: 1.2em;
        }

        .text-center {
            text-align: center;
        }

        .text-start {
            text-align: left;
        }

        .text-end {
            text-align: right;
        }

        .font-semibold {
            font-weight: 500;
        }

        .font-bold {
            font-weight: bold;
        }

        .font-bolder {
            font-weight: bolder;
        }

        .font-lighter {
            font-weight: lighter;
        }

        .text-uppercase {
            text-transform: uppercase;
        }

        table {
            width: 100%;
        }

        table thead {
            vertical-align: middle;
        }

        table.bordered {
            margin-top: 1rem;
            border-collapse: collapse;
        }

        table.bordered th {
            text-align: center;
        }

        table.bordered td,
        table.bordered th {
            border: 1px solid #ddd;
            padding: 3px;
        }

        table.bordered th {
            padding-top: 12px;
            padding-bottom: 12px;
            background-color: rgb(142 75 16);
            color: #fff;
        }

        table.bordered td {
            vertical-align: top;
        }

        .page-break {
            page-break-after: always;
        }

        .page-break-inside-avoid {
            page-break-inside: avoid;
        }

        .logo {
            position: relative;
            width: 80px;
        }

        .valign-middle {
            vertical-align: middle !important;
        }

        .mt-4 {
            margin-top: 2rem;
        }

        .d-flex {
            display: flex;
        }

        .align-items-center {
            align-items: center;
        }

        .w-100 {
            width: 100%;
        }

        .underline {
            text-decoration: underline;
        }

        .text-xs {
            font-size: .75em;
        }

        .text-sm {
            font-size: .875em;
        }

        .uppercase {
            text-transform: uppercase
        }

        .italic {
            font-style: italic;
        }

        .p-4 {
            padding: 1rem;
        }

        .border {
            border: 1px solid #ddd;
        }

        .pb-3 {
            padding-bottom: .75rem;
        }

        .mt-3 {
            margin-top: .75rem;
        }

        .border-b {
            border-bottom-width: 1px;
        }
    </style>
</head>

<body>
    <img style="float:left;" src="{{ base_path('resources/images/logo.png') }}" alt="Logo" class="logo">
    <div style="float:right;width:100%" class="text-end">
        <h5 class="font-bold uppercase">
            {{ __('Income Report') }}
            <br />
            {{ config('app.name') }}
            <br />
            {{ Carbon::createFromFormat('m', $month)->translatedFormat('F') . ' ' . $year }}
        </h5>
    </div>

    <div style="clear: both" class="mt-4">
        <table class="w-100 bordered">
            <thead class="text-center bg-gray-100">
                <tr class="text-center">
                    <th width="40px" scope="col">
                        #
                    </th>
                    <th scope="col">
                        {{ __(':name Name', ['name' => __('Product')]) }}
                    </th>
                    <th scope="col">
                        {{ __('Sales Income') }} (Rp)
                    </th>
                    <th scope="col">
                        {{ __('Cost') }} (Rp)
                    </th>
                    <th scope="col">
                        {{ __('Net') }} (Rp)
                    </th>
                </tr>
            </thead>
            <tbody>
                @forelse ($products['results'] as $product)
                    <tr>
                        <td class="text-center">
                            {{ $loop->iteration }}
                        </td>
                        <td>
                            <div class="font-semibold underline">
                                #{{ $product['id'] }}
                            </div>
                            <span class="font-semibold">
                                {{ $product['name'] }}
                            </span>
                            /
                            <span class="text-sm italic">
                                {{ $product['category_name'] }}
                            </span>
                        </td>
                        <td class="text-end">
                            {{ StringHelper::currency(collect($product['results'][0]['results'])->sum('sales_income')) }}
                        </td>
                        <td class="text-end">
                            {{ StringHelper::currency(collect($product['results'][0]['results'])->sum('cost')) }}
                        </td>
                        <td class="text-end">
                            {{ StringHelper::currency(collect($product['results'][0]['results'])->sum(fn($q) => $q['sales_income'] - $q['cost'])) }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center">
                            <span>
                                {{ __('No data found.') }}
                            </span>
                        </td>
                    </tr>
                @endforelse
                <tr class="font-bold">
                    <td colspan="2" class="text-center">
                        {{ __('Total') }}
                    </td>
                    <td class="text-end">
                        {{ StringHelper::currency($products['total_sales']['sales_income']) }}
                    </td>
                    <td class="text-end">
                        {{ StringHelper::currency($products['total_sales']['cost']) }}
                    </td>
                    <td class="text-end">
                        {{ StringHelper::currency($products['total_sales']['net']) }}
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        <table class="bordered">
            <tr>
                <td width="50%" class="p-4 font-bold valign-middle">
                    <h5 class="font-bold">{{ __('Highest Income Sales') }}</h5>
                </td>
                <td class="p-4 valign-middle">
                    @forelse ($products['highest_income_products']['products'] as $product)
                        <div @class([
                            'pb-3' => !$loop->last,
                            'border-b' => !$loop->last,
                            'mt-3' => !$loop->first,
                        ])>
                            <div class="font-semibold underline">
                                #{{ $product['id'] }}
                            </div>
                            <div class="font-semibold">
                                {{ $product['name'] }}
                            </div>
                            <div class="text-sm">
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
                </td>
            </tr>
        </table>
    </div>
</body>

</html>
