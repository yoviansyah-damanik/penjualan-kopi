<html>

<head>

    <head>
        <style>
            html {
                font-size: 14px;
                font-family: Arial, Helvetica, sans-serif;
            }

            .box-bordered {
                border: 1px solid #ddd;
                padding: 1.5rem;
                width: 100%;
                max-width: 820px;
            }

            h5 {
                font-size: 1.4em;
                margin: 0;
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
                background-color: #991b1b;
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
                width: 150px;
            }

            .valign-middle {
                vertical-align: middle !important;
            }

            .mt-3 {
                margin-top: 1.5rem;
            }

            .mt-4 {
                margin-top: 2rem;
            }

            .mb-0 {
                margin-bottom: 0;
            }

            p {
                margin: 0;
                line-height: 1.5;
            }

            .italic {
                font-style: italic;
            }
        </style>
    </head>
</head>

<body>
    <div class="box-bordered w-100">
        <h5>#{{ $transaction->id }}</h5>

        <div class="mt-3">
            <p>
                <strong>{{ __('Orderer Name') }}:</strong> {{ $transaction->orderer_name }}
            </p>
            <p>
                <strong>{{ __('Address') }}:</strong> {{ $transaction->address }}
            </p>
            <p>
                <strong>{{ __('Phone Number') }}:</strong> {{ $transaction->phone_number }}
            </p>
            <p>
                <strong>{{ __('Date') }}:</strong>
                {{ Carbon::parse($transaction->date)->translatedFormat('d F Y') }}
            </p>
        </div>

        <div class="mt-3">
            <strong>{{ __('Status') }}:</strong>
            {{ __(Str::headline($transaction->status)) }}
        </div>

        <div class="mt-3">
            <table class="bordered">
                <thead>
                    <th>#</th>
                    <th>{{ __(':name Name', ['name' => __('Product')]) }}</th>
                    <th>{{ __('Price') }} (Rp)</th>
                    <th>{{ __('Qty') }}</th>
                    <th>{{ __('Amount') }} (Rp)</th>
                </thead>
                <tbody>
                    @foreach ($transaction->details as $item)
                        <tr>
                            <td class="text-center">
                                {{ $loop->iteration }}
                            </td>
                            <td>
                                {{ $item->product->name }}
                            </td>
                            <td class="text-end">
                                {{ StringHelper::currency($item->final_price) }}
                            </td>
                            <td class="text-center">
                                {{ $item->qty }}
                            </td>
                            <td class="text-end">
                                {{ StringHelper::currency($item->total) }}
                            </td>
                        </tr>
                    @endforeach
                    <tr>
                        <td colspan=3 class="font-bold text-center">
                            {{ __('Total') }}
                        </td>
                        <td class="text-center">{{ $transaction->details->sum('qty') }}</td>
                        <td class="text-end">{{ StringHelper::currency($transaction->details->sum('total')) }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="mt-3 text-end">
                <strong>{{ __('Sub Total') }}:</strong>
                <span>
                    {{ StringHelper::currency($transaction->details->sum('total'), true) }}
                </span>
            </div>
            <div class="mt-1 text-end">
                <strong>{{ __('Shipping Cost') }}:</strong>
                <span>
                    {{ StringHelper::currency($transaction->shipping->cost, true) }}
                </span>
            </div>
            <div class="mt-1 text-end">
                <strong>{{ __('Unique Code') }}:</strong>
                <span>
                    {{ StringHelper::currency($transaction->unique_code) }}
                </span>
            </div>
            <div class="mt-3 text-end">
                <strong>{{ __('Total') }}</strong>
                <h5>
                    {{ StringHelper::currency($transaction->total_payment, true) }}
                </h5>
            </div>
        </div>

        <p class="mt-3">
            Mohon maaf. Transaksi anda telah dibatalkan. Beberapa penyebab dibatalkan:
        <ol>
            <li>Bukti pembayaran tidak valid</li>
            <li>Jumlah biaya yang dikirim tidak sesuai dengan nilai transaksi</li>
            <li>Jumlah produk yang dipesan tidak masuk akal</li>
            <li>Ketidaksesuaian status produk dengan ketersediaan produk saat ini</li>
        </ol>
        Jika anda telah melakukan pembayaran transaksi, kami akan menghubungi anda terkait pengembalian dana dalam waktu
        2x24 jam. Terima Kasih.
        </p>
        <a href="{{ route('dashboard.transaction.show', base64_encode($transaction->id)) }}"
            target="_blank">{{ route('dashboard.transaction.show', base64_encode($transaction->id)) }}</a>

        <p class="mt-3 italic">
            Mohon untuk tidak membalas pesan ini. Pesan ini dikirimkan secara otomatis oleh aplikasi
            {{ config('app.name') }}.
        </p>
    </div>
</body>

</html>
