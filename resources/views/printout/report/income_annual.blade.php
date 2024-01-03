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
            padding: 2px;
        }

        table.bordered th {
            padding-top: 6px;
            padding-bottom: 6px;
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

        .border-s-0 {
            border-left-width: 0 !important;
        }

        .border-e-0 {
            border-right-width: 0 !important;
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
            {{ Carbon::createFromFormat('Y', $year)->startOfYear()->translatedFormat('F') .' - ' .Carbon::createFromFormat('Y', $year)->endOfYear()->translatedFormat('F') .' ' .$year }}
        </h5>
    </div>

    <div style="clear: both" class="mt-4">
        <table class="w-100 bordered">
            <thead class="text-center">
                <tr>
                    <th scope="col" rowspan="2" width="25px">
                        #
                    </th>
                    <th scope="col" rowspan="2">
                        {{ __(':name Name', ['name' => __('Product')]) }}
                    </th>
                    <th colspan="12" scope="col">
                        {{ __('Net') }} (Rp)
                    </th>
                    <th scope="col" rowspan="2">
                        {{ __('Total Net') }} (Rp)
                    </th>
                </tr>
                <tr>
                    @foreach (range(1, 12) as $y)
                        <th>
                            {{ Carbon::createFromFormat('m', $y)->translatedFormat('M') }}
                        </th>
                    @endforeach
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
                            <div class="font-semibold">
                                {{ $product['name'] }}
                            </div>
                            <div>
                                {{ $product['category_name'] }}
                            </div>
                        </td>
                        @foreach (range(1, 12) as $y)
                            <td class="border text-end">
                                {{ StringHelper::currency($product['results'][$y - 1]['total']['net']) }}
                            </td>
                        @endforeach
                        <td class="font-bold text-end">
                            {{ StringHelper::currency(collect($product['results'])->sum('total.net')) }}
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
                    <td colspan=2 class="font-bold text-center">
                        {{ __('Total') }}
                    </td>
                    @foreach (range(1, 12) as $y)
                        <td class="text-end">
                            {{ StringHelper::currency(collect($products['results'])->sum('results.' . $y - 1 . '.total.net')) }}
                        </td>
                    @endforeach
                    <td class="text-end border-s-0">
                        {{ StringHelper::currency(collect($products['results'])->sum(fn($q) => collect($q['results'])->sum('total.net')), true) }}
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        <table class="bordered">
            <tr>
                <td width="50%" class="p-4 font-bold valign-middle">
                    <h5 class="font-bold">{{ __('Best Selling Product') }}</h5>
                </td>
                <td class="p-4 valign-middle">
                    @forelse ($products['highest_income_products']['products'] as $product)
                        <div @class([
                            'pb-3' => !$loop->last,
                            'border-b' => !$loop->last,
                            'mt-3' => !$loop->first,
                        ])>
                            <div class="text-base font-semibold underline">
                                #{{ $product['id'] }}
                            </div>
                            <div class="text-base font-semibold">
                                {{ $product['name'] }}
                            </div>
                            <div class="text-sm font-normal">
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
