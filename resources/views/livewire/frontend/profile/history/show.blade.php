<div class="min-h-[60vh]">
    <div class="container py-12">
        <ul class="flex gap-2">
            <li>
                <a class="px-4 py-2 transition duration-100 rounded-md bg-orange-900/10 hover:bg-orange-900 hover:text-white @if (request()->routeIs('profile')) pointer-events-none cursor-not-allowed bg-orange-950 text-white @endif"
                    href="{{ route('profile') }}" wire:navigate>
                    {{ __('Account') }}
                </a>
            </li>
            <li>
                <a class="px-4 py-2 transition duration-100 rounded-md bg-orange-900/10 hover:bg-orange-900 hover:text-white @if (request()->routeIs('profile.history*')) pointer-events-none cursor-not-allowed bg-orange-950 text-white @endif"
                    href="{{ route('profile.history') }}" wire:navigate>
                    {{ __('History') }}
                </a>
            </li>
        </ul>

        <div class="mt-7">
            <a class="main-btn bg-gradient-to-br from-orange-950 to-red-700" href="{{ route('profile.history') }}"
                wire:navigate>{{ __('Back to history') }}</a>
            @if ($transaction->delivery)
                <div class="flex flex-col items-stretch justify-between gap-3 mt-3 lg:items-center lg:flex-row">
                    <div class="flex-auto -space-y-0.5 border p-4 rounded-lg">
                        <div>
                            <span class="font-medium">
                                {{ __('Orderer Name') }}:
                            </span>
                            <span class="text-base">
                                {{ $transaction->orderer_name }}
                            </span>
                        </div>
                        <div>
                            <span class="font-medium">
                                {{ __('Route') }}:
                            </span>
                            <span class="text-base">
                                {{ $transaction->shipping->origin }} - {{ $transaction->shipping->city }}
                            </span>
                        </div>
                        <div>
                            <span class="font-medium">
                                {{ __('Address') }}:
                            </span>
                            <span class="text-base">
                                {{ $transaction->address }}
                            </span>
                        </div>
                        <div>
                            <span class="font-medium">
                                {{ __('Delivery Code') }}:
                            </span>
                            <span class="text-base">
                                {{ $transaction->delivery->code }}
                            </span>
                        </div>
                        <div>
                            <span class="font-medium">
                                {{ __('Description') }}:
                            </span>
                            <span class="text-base">
                                {{ $transaction->delivery->description ?? '-' }}
                            </span>
                        </div>
                        <div>
                            <span class="font-medium">
                                {{ __('Status') }}:
                            </span>
                            <span @class([
                                'text-sm',
                                'py-[.125rem]',
                                'px-2',
                                'bg-green-100' =>
                                    $transaction->delivery->status ==
                                    \App\Enums\DeliveryStatusType::Arrived,
                                'bg-yellow-100' =>
                                    $transaction->delivery->status ==
                                    \App\Enums\DeliveryStatusType::OnDelivery,
                                'text-green-700' =>
                                    $transaction->delivery->status ==
                                    \App\Enums\DeliveryStatusType::Arrived,
                                'text-yellow-700' =>
                                    $transaction->delivery->status ==
                                    \App\Enums\DeliveryStatusType::OnDelivery,
                            ])>
                                {{ __(Str::headline($transaction->delivery->status)) }}
                            </span>
                        </div>
                    </div>
                    <div class="flex-none w-auto">
                        @if ($transaction?->delivery?->status == \App\Enums\DeliveryStatusType::OnDelivery)
                            <div
                                class="flex items-end justify-center gap-3 px-5 py-2 mb-3 text-orange-700 bg-orange-100 border rounded-xl">
                                <svg xmlns="http://www.w3.org/2000/svg" width="80" height="64"
                                    viewBox="0 0 640 512">
                                    <path fill="currentColor"
                                        d="M112 0C85.5 0 64 21.5 64 48v48H16c-8.8 0-16 7.2-16 16s7.2 16 16 16h256c8.8 0 16 7.2 16 16s-7.2 16-16 16H48c-8.8 0-16 7.2-16 16s7.2 16 16 16h192c8.8 0 16 7.2 16 16s-7.2 16-16 16H16c-8.8 0-16 7.2-16 16s7.2 16 16 16h192c8.8 0 16 7.2 16 16s-7.2 16-16 16H64v128c0 53 43 96 96 96s96-43 96-96h128c0 53 43 96 96 96s96-43 96-96h32c17.7 0 32-14.3 32-32s-14.3-32-32-32V237.3c0-17-6.7-33.3-18.7-45.3L512 114.7c-12-12-28.3-18.7-45.3-18.7H416V48c0-26.5-21.5-48-48-48zm432 237.3V256H416v-96h50.7zM160 368a48 48 0 1 1 0 96a48 48 0 1 1 0-96m272 48a48 48 0 1 1 96 0a48 48 0 1 1-96 0" />
                                </svg>
                                <div>
                                    <div class="font-bold">
                                        {{ __('Your order is on its way') }}
                                    </div>
                                    <div class="text-sm">
                                        <a class="italic font-light hover:underline" href="https://tiki.id/id/track"
                                            target="_blank">https://tiki.id/id/track</a>
                                        <div class="font-normal">
                                            {{ __('Delivery Code') }}: {{ $transaction->delivery->code }}
                                        </div>
                                        <div class="font-light">
                                            {{ __('Estimated Arrival') }}:
                                            {{ $transaction->delivery->created_at->addDays($transaction->shipping->estimation_day)->translatedFormat('d M Y') }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button
                                wire:confirm="{{ __('Are you sure you want to complete the :feature?', ['feature' => __('order')]) }}"
                                wire:click="complete"
                                class="w-full px-3 py-2 text-white duration-150 bg-orange-700 rounded-md hover:bg-orange-950">
                                {{ __('Complete the order') }}
                            </button>
                        @else
                            <div
                                class="flex flex-col items-center justify-center gap-3 p-5 min-w-[250px] text-green-700 bg-green-100 border border-green-300 rounded-xl">
                                <svg xmlns="http://www.w3.org/2000/svg" width="60" height="60"
                                    viewBox="0 0 16 16">
                                    <g fill="currentColor">
                                        <path
                                            d="M8 7.982C9.664 6.309 13.825 9.236 8 13C2.175 9.236 6.336 6.31 8 7.982" />
                                        <path
                                            d="M3.75 0a1 1 0 0 0-.8.4L.1 4.2a.5.5 0 0 0-.1.3V15a1 1 0 0 0 1 1h14a1 1 0 0 0 1-1V4.5a.5.5 0 0 0-.1-.3L13.05.4a1 1 0 0 0-.8-.4h-8.5Zm0 1H7.5v3h-6zM8.5 4V1h3.75l2.25 3zM15 5v10H1V5z" />
                                    </g>
                                </svg>
                                <span class="text-base">
                                    {{ __('Order has been received') }}
                                </span>
                            </div>
                        @endif
                    </div>
                </div>
            @endif
            <div class="grid grid-cols-1 gap-3 mt-4 lg:grid-cols-6">
                <div class="order-1 lg:col-span-4 lg:order-none">
                    <div class="max-h-[70vh] overflow-y-auto">
                        @foreach ($transaction->details as $detail)
                            <div class="mb-3 overflow-hidden bg-gray-100 rounded-lg">
                                <div class="flex flex-wrap items-center overflow-hidden">
                                    <div class="flex-grow-0 flex-shrink-0 basis-[90px]">
                                        <img class="w-full aspect-square"
                                            src="{{ $detail->product->main_image ?? Vite::image('product-default.png') }}"
                                            alt="{{ $detail->product->name }} Image">
                                    </div>
                                    <div
                                        class="flex-grow-0 flex-shrink-0 basis-[calc(100%-90px)] overflow-hidden flex lg:items-center justify-between flex-col lg:flex-row px-4 py-3">
                                        <a wire:navigate href="{{ route('product.show', $detail->product->slug) }}"
                                            class="block overflow-hidden font-semibold text-ellipsis whitespace-nowrap navigate-link">
                                            {{ $detail->product->name }}
                                            <div class="text-sm font-light">
                                                {{ $detail->product->category_name }}
                                            </div>
                                        </a>
                                        <div class="px-3 mt-3 text-sm text-end">
                                            {{ $cart->qty }} x @
                                            {{ StringHelper::currency($cart->product->final_price, true) }}
                                            <div class="italic">
                                                {{ StringHelper::currency($cart->qty * $cart->product->final_price, true) }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="order-none lg:col-span-2 lg:order-1">
                    <div @class([
                        'bg-yellow-100' =>
                            $transaction->status ==
                            \App\Enums\TransactionStatusType::WaitingForPayment,
                        'bg-teal-100' =>
                            $transaction->status ==
                            \App\Enums\TransactionStatusType::WaitingForConfirmation,
                        'bg-cyan-100' =>
                            $transaction->status ==
                            \App\Enums\TransactionStatusType::WaitingForDelivery,
                        'bg-green-100' =>
                            $transaction->status == \App\Enums\TransactionStatusType::Completed,
                        'bg-red-100' =>
                            $transaction->status == \App\Enums\TransactionStatusType::Canceled,
                        'border-yellow-300' =>
                            $transaction->status ==
                            \App\Enums\TransactionStatusType::WaitingForPayment,
                        'border-teal-300' =>
                            $transaction->status ==
                            \App\Enums\TransactionStatusType::WaitingForConfirmation,
                        'border-cyan-300' =>
                            $transaction->status ==
                            \App\Enums\TransactionStatusType::WaitingForDelivery,
                        'border-green-300' =>
                            $transaction->status == \App\Enums\TransactionStatusType::Completed,
                        'border-red-300' =>
                            $transaction->status == \App\Enums\TransactionStatusType::Canceled,
                        'text-yellow-700' =>
                            $transaction->status ==
                            \App\Enums\TransactionStatusType::WaitingForPayment,
                        'text-teal-700' =>
                            $transaction->status ==
                            \App\Enums\TransactionStatusType::WaitingForConfirmation,
                        'text-cyan-700' =>
                            $transaction->status ==
                            \App\Enums\TransactionStatusType::WaitingForDelivery,
                        'text-green-700' =>
                            $transaction->status == \App\Enums\TransactionStatusType::Completed,
                        'text-red-700' =>
                            $transaction->status == \App\Enums\TransactionStatusType::Canceled,
                        'flex',
                        'justify-center',
                        'items-center',
                        'gap-3',
                        'px-5',
                        'py-2',
                        'text-gray-700',
                        'border',
                        'rounded-xl',
                        'mb-3',
                    ])>
                        @if ($transaction->status == \App\Enums\TransactionStatusType::Completed)
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                <path fill="none" stroke="currentColor" stroke-linecap="round"
                                    stroke-linejoin="round" stroke-width="2"
                                    d="M9.615 20H7a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v8m-3 5l2 2l4-4M9 8h4m-4 4h2" />
                            </svg>
                        @elseif($transaction->status == \App\Enums\TransactionStatusType::WaitingForPayment)
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 14 14">
                                <g fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round">
                                    <rect width="10.5" height="8" x=".5" y="1.75" rx="1" />
                                    <circle cx="5.75" cy="5.75" r="1.5" />
                                    <path d="M3.5 12.25h9a1 1 0 0 0 1-1v-5" />
                                </g>
                            </svg>
                        @elseif($transaction->status == \App\Enums\TransactionStatusType::WaitingForDelivery)
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                <g fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2">
                                    <path d="M2 3h1a2 2 0 0 1 2 2v10a2 2 0 0 0 2 2h15" />
                                    <path
                                        d="M9 9a3 3 0 0 1 3-3h4a3 3 0 0 1 3 3v2a3 3 0 0 1-3 3h-4a3 3 0 0 1-3-3zM7 19a2 2 0 1 0 4 0a2 2 0 1 0-4 0m9 0a2 2 0 1 0 4 0a2 2 0 1 0-4 0" />
                                </g>
                            </svg>
                        @elseif($transaction->status == \App\Enums\TransactionStatusType::Canceled)
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                <path fill="none" stroke="currentColor" stroke-linecap="round"
                                    stroke-linejoin="round" stroke-width="2" d="M17 7L7 17M7 7l10 10" />
                            </svg>
                        @else
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                viewBox="0 0 24 24">
                                <path fill="currentColor"
                                    d="M1 21L12 2l11 19H1Zm3.45-2h15.1L12 6L4.45 19ZM12 18q.425 0 .713-.288T13 17q0-.425-.288-.713T12 16q-.425 0-.713.288T11 17q0 .425.288.713T12 18Zm-1-3h2v-5h-2v5Zm1-2.5Z" />
                            </svg>
                        @endif
                        <span class="text-base">
                            {{ __(Str::headline($transaction->status)) }}
                        </span>
                    </div>
                    @if (in_array($transaction->status, [
                            \App\Enums\TransactionStatusType::WaitingForPayment,
                            \App\Enums\TransactionStatusType::WaitingForConfirmation,
                        ]))
                        <button
                            wire:confirm="{{ __('Are you sure you want to cancel the :feature?', ['feature' => __('order')]) }}"
                            wire:click="cancel"
                            class="inline-block w-full px-4 py-2 text-white duration-150 bg-red-700 rounded-lg hover:bg-red-950">
                            {{ __('Cancel the order') }}
                        </button>
                    @endif
                    <div class="p-4 border rounded-lg">
                        <div class="space-y-3">
                            <div>
                                <div class="mb-1 font-light">
                                    {{ __('Orderer Name') }}
                                </div>
                                <div class="font-medium">
                                    {{ $transaction->orderer_name }}
                                </div>
                            </div>
                            <div>
                                <div class="mb-1 font-light">
                                    {{ __('Address') }}
                                </div>
                                <div class="font-medium">
                                    {{ $transaction->address }}
                                </div>
                            </div>
                            <div>
                                <div class="mb-1 font-light">
                                    {{ __('Phone Number') }}
                                </div>
                                <div class="font-medium">
                                    {{ $transaction->phone_number }}
                                </div>
                            </div>
                            <div>
                                <div class="mb-1 font-light">
                                    {{ __('Province') }}
                                </div>
                                <div class="font-medium">
                                    {{ $transaction->shipping->province ?? '-' }}
                                </div>
                            </div>
                            <div>
                                <div class="mb-1 font-light">
                                    {{ __('City') }}
                                </div>
                                <div class="font-medium">
                                    {{ $transaction->shipping->city ?? '-' }}
                                </div>
                            </div>
                            <div>
                                <div class="mb-1 font-light">
                                    {{ __('Note') }}
                                </div>
                                <div class="font-medium">
                                    {{ $transaction->note ?? '-' }}
                                </div>
                            </div>
                            <div>
                                <div class="mb-1 font-light">
                                    {{ __('Estimation Delivery') }}
                                </div>
                                <div class="font-medium">
                                    {{ $transaction->shipping->estimation_day > 1 ? __(':day days', ['day' => StringHelper::currency($transaction->shipping->estimation_day)]) : __(':day day', ['day' => StringHelper::currency($estimation_day)]) }}
                                </div>
                            </div>
                            <div class="mt-4">
                                <table class="w-full font-medium">
                                    <tbody>
                                        <tr>
                                            <td class="p-2 border-b whitespace-nowrap">
                                                {{ __('Subtotal') }}
                                            </td>
                                            <td class="p-2 border-b text-end whitespace-nowrap">
                                                {{ StringHelper::currency($transaction->total_payment_products_only) }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="p-2 border-b whitespace-nowrap">
                                                {{ __('Shipping Cost') }}:
                                            </td>
                                            <td class="p-2 border-b text-end whitespace-nowrap">
                                                {{ StringHelper::currency($transaction->shipping->cost) }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="p-2 border-b whitespace-nowrap">
                                                {{ __('Unique Code') }}
                                            </td>
                                            <td class="p-2 border-b text-end whitespace-nowrap">
                                                {{ $transaction->unique_code }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="p-2 border-b whitespace-nowrap">
                                                {{ __('Total Payment') }}
                                            </td>
                                            <td class="p-2 border-b text-end whitespace-nowrap">
                                                {{ StringHelper::currency($transaction->total_payment) }}
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @if (in_array($transaction->status, [
                    \App\Enums\TransactionStatusType::WaitingForPayment,
                    \App\Enums\TransactionStatusType::WaitingForConfirmation,
                    \App\Enums\TransactionStatusType::WaitingForDelivery,
                ]))
                <div class="pt-4 border-b"></div>
                <div class="pt-4">
                    <livewire:frontend.profile.history.payment :$transaction lazy />
                </div>
            @endif
        </div>
    </div>
</div>
