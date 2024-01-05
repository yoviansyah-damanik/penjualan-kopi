<div @class([
    'overflow-hidden',
    'border',
    'rounded-lg',
    'mb-3',
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
])>
    <div @class([
        'flex',
        'items-center',
        'justify-between',
        'px-4',
        'py-2',
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
    ])>
        <div class="flex flex-items lg:items-center">
            <div class="hidden text-lg font-bold lg:block">
                #{{ $transaction->id }}
            </div>
            <div class="px-2 py-[.125rem] text-xs text-orange-700 bg-orange-100 lg:ms-2 rounded-lg">
                {{ Carbon::parse($transaction->date)->translatedFormat('d M Y') }}
            </div>
        </div>
        <div class="text-base">
            {{ __(Str::headline($transaction->status)) }}
        </div>
    </div>
    <div class="p-4 bg-white">
        <div class="flex flex-col lg:flex-row">
            <div class="flex flex-none w-full pb-2 lg:w-3/4 lg:pb-0">
                @php
                    $detail = $transaction->details();
                    $product = $detail->first()->product;
                @endphp
                <div class="flex-none w-[70px]">
                    <img src="{{ $product->main_image_path }}" class="w-full aspect-square"
                        alt="{{ $product->name }} Image">
                </div>
                <div class="flex-none">
                    <div class="px-2 py-1">
                        <a href="{{ route('product.show', $product->slug) }}" wire:navigate class="font-bold">
                            {{ $product->name }}
                        </a>
                        <div class="text-sm text-gray-700 text-light">
                            {{ $product->category_name }} -
                            {{ StringHelper::currency($product->weight) }} gram
                        </div>
                        @if ($detail->count() - 1 > 0)
                            <div class="text-sm text-gray-700 text-light">
                                @if ($detail->count() - 1 == 1)
                                    {{ __(':count other product', ['count' => $detail->count() - 1]) }}
                                @else
                                    {{ __(':count other products', ['count' => $detail->count() - 1]) }}
                                @endif
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="flex-none w-full pt-2 border-t lg:pt-0 lg:border-t-0 lg:w-1/4 lg:border-s lg:ps-2">
                {{ __('Total Payment') }}
                <div class="font-bold text-orange-950">
                    {{ StringHelper::currency($transaction->totalPayment, true) }}
                </div>
                <div class="text-sm text-gray-700 text-light">
                    {{ StringHelper::currency($transaction->totalItem) }} item
                </div>
            </div>
        </div>
    </div>
    <div class="flex flex-col items-center justify-between px-4 py-3 text-sm border-t lg:text-base lg:flex-row">
        <div class="flex-none">
            <a href="{{ route('profile.history.detail', base64_encode($transaction->id)) }}"
                wire:navigate>{{ __('See Transaction') }}</a>
        </div>
        @if ($transaction->delivery)
            <div class="flex-none mt-3 lg:mt-0">
                @if ($transaction->delivery->status == \App\Enums\DeliveryStatusType::OnDelivery)
                    <button
                        wire:confirm="{{ __('Are you sure you want to complete the :feature?', ['feature' => __('order')]) }}"
                        wire:click="complete"
                        class="me-1 inline-block px-4 py-[.125rem] bg-green-700 hover:bg-green-950 duration-150 text-white rounded-lg">
                        {{ __('Complete the order') }}
                    </button>
                    <div class="inline-block px-4 py-[.125rem] text-orange-700 bg-orange-100 rounded-lg">
                        {{ __('Estimated Arrival') }}:
                        {{ $transaction->delivery->created_at->addDays($transaction->shipping->estimation_day)->translatedFormat('d M Y') }}
                    </div>
                @else
                    <span class="py-[.125rem] px-4 text-green-700 bg-green-100 rounded-lg">
                        {{ __('Order has been received') }}
                    </span>
                @endif
            </div>
        @endif
        @if ($transaction->status == \App\Enums\TransactionStatusType::WaitingForPayment)
            <div class="flex-none">
                <button
                    wire:confirm="{{ __('Are you sure you want to cancel the :feature?', ['feature' => __('order')]) }}"
                    wire:click="cancel"
                    class="inline-block px-4 py-[.125rem] bg-red-700 hover:bg-red-950 duration-150 text-white rounded-lg">
                    {{ __('Cancel the order') }}
                </button>
            </div>
        @endif
    </div>
</div>
