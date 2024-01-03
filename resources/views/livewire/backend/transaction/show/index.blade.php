<div>
    <div class="p-4 mx-4 my-6 bg-white rounded-lg shadow md:p-6 xl:p-8 dark:bg-gray-800">
        {{-- USER STATUS --}}
        <div class="flex flex-col-reverse items-center justify-between lg:flex-row">
            <div class="flex-none">
                <div class="mb-3 font-bold">
                    {{ __(':status Status', ['status' => __('User')]) }}
                </div>
                <div class="inline-flex flex-col gap-3 lg:flex-row">
                    <div class="inline-block border rounded-lg min-w-[350px] overflow-hidden">
                        <div class="flex">
                            <div class="w-24">
                                <img class="w-full" src="{{ $transaction->user->image_path }}"
                                    alt="{{ $transaction->user->name }} Image">
                            </div>
                            <div class="px-5 my-auto">
                                <div class="-space-y-[.375rem]">
                                    <div class="font-medium">
                                        {{ $transaction->user->name }}
                                    </div>
                                    <div class="font-light">
                                        {{ $transaction->user->username }}
                                    </div>
                                    <div class="italic font-light">
                                        {{ $transaction->user->email }}
                                    </div>
                                </div>
                                <div class="flex gap-2 text-xs text-gray-700">
                                    <div class="flex items-baseline gap-1">
                                        <span class="w-2 bg-green-300 rounded-full aspect-square"></span>
                                        {{ StringHelper::currency($transaction->user->transactions()->status(\App\Enums\TransactionStatusType::Completed)->count()) }}
                                        {{ __('Completed') }}
                                    </div>
                                    <div class="flex items-baseline gap-1">
                                        <span class="w-2 bg-red-300 rounded-full aspect-square"></span>
                                        {{ StringHelper::currency($transaction->user->transactions()->status(\App\Enums\TransactionStatusType::Canceled)->count()) }}
                                        {{ __('Canceled') }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex-none mb-3 lg:mb-0">
                <span @class([
                    'border',
                    'bg-yellow-100' =>
                        $transaction->status ==
                        \App\Enums\TransactionStatusType::WaitingForPayment,
                    'bg-cyan-100' =>
                        $transaction->status ==
                        \App\Enums\TransactionStatusType::WaitingForDelivery,
                    'bg-teal-100' =>
                        $transaction->status ==
                        \App\Enums\TransactionStatusType::WaitingForConfirmation,
                    'bg-green-100' =>
                        $transaction->status == \App\Enums\TransactionStatusType::Completed,
                    'bg-red-100' =>
                        $transaction->status == \App\Enums\TransactionStatusType::Canceled,
                    'border-yellow-300' =>
                        $transaction->status ==
                        \App\Enums\TransactionStatusType::WaitingForPayment,
                    'border-cyan-300' =>
                        $transaction->status ==
                        \App\Enums\TransactionStatusType::WaitingForDelivery,
                    'border-teal-300' =>
                        $transaction->status ==
                        \App\Enums\TransactionStatusType::WaitingForConfirmation,
                    'border-green-300' =>
                        $transaction->status == \App\Enums\TransactionStatusType::Completed,
                    'border-red-300' =>
                        $transaction->status == \App\Enums\TransactionStatusType::Canceled,
                    'rounded-lg',
                    'px-3',
                    'py-1',
                    'text-xs',
                    'font-bold',
                ])>
                    {{ __(Str::headline($transaction->status)) }}
                </span>
            </div>
        </div>
        <div class="my-3 border-b"></div>
        <div class="flex flex-col gap-3 lg:flex-row mb-7">
            {{-- ORDER INFORMATION --}}
            <div class="flex-none w-1/2">
                <div class="mb-3 font-bold">
                    {{ __(':info Information', ['info' => __('Order')]) }}
                </div>
                <div class="space-y-0.5">
                    <div>
                        <span class="font-medium">
                            {{ __('Total Payment') }}:
                        </span>
                        <span class="text-base">
                            {{ StringHelper::currency($transaction->total_payment, true) }}
                        </span>
                    </div>
                    <div>
                        <span class="font-medium">
                            {{ __('Total :total', ['total' => __('Items')]) }}:
                        </span>
                        <span class="text-base">
                            {{ StringHelper::currency($transaction->details->sum('qty')) }} item
                        </span>
                    </div>
                    <div>
                        <span class="font-medium">
                            {{ __('Weight') }}:
                        </span>
                        <span class="text-base">
                            {{ StringHelper::currency($transaction->shipping->weight) }} gram
                        </span>
                    </div>
                </div>
            </div>
            {{-- SHIPPING INFORMATION --}}
            <div class="flex-none w-1/2">
                <div class="mb-3 font-bold">
                    {{ __(':info Information', ['info' => __('Shipping')]) }}
                </div>
                <div class="space-y-0.5">
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
                            {{ __('Phone Number') }}:
                        </span>
                        <span class="text-base">
                            {{ $transaction->phone_number }}
                        </span>
                    </div>
                </div>
            </div>
        </div>
        {{-- ITEMS --}}
        <div class="mb-5 overflow-x-auto">
            <div class="inline-block min-w-full align-middle">
                <div class="overflow-hidden shadow">
                    <table class="min-w-full divide-y divide-gray-200 table-fixed dark:divide-gray-600">
                        <thead class="bg-gray-100 dark:bg-gray-700">
                            <tr>
                                <th scope="col"
                                    class="p-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">
                                    #
                                </th>
                                <th scope="col"
                                    class="p-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">
                                    {{ __(':name Name', ['name' => __('product')]) }}
                                </th>
                                <th scope="col"
                                    class="p-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">
                                    {{ __('Price') }}
                                </th>
                                <th scope="col"
                                    class="p-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">
                                    {{ __('Quantities') }}
                                </th>
                                <th scope="col"
                                    class="p-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">
                                    {{ __('Total') }}
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-700">
                            @foreach ($transaction->details as $item)
                                <tr>
                                    <td
                                        class="p-4 text-sm font-normal text-gray-500 whitespace-nowrap dark:text-gray-400">
                                        {{ $loop->iteration }}
                                    </td>
                                    <td
                                        class="p-4 text-sm font-normal text-gray-500 whitespace-nowrap dark:text-gray-400">
                                        <div class="text-base font-semibold text-gray-900 underline dark:text-white">
                                            #{{ $item->product->id }}
                                        </div>
                                        <div class="text-base font-semibold text-gray-900 dark:text-white">
                                            {{ $item->product->name }}
                                        </div>
                                        <div class="text-sm font-normal text-gray-500 dark:text-gray-400">
                                            {{ $item->product->category_name }}
                                        </div>
                                    </td>
                                    <td
                                        class="p-4 text-sm font-normal text-gray-500 whitespace-nowrap dark:text-gray-400">
                                        {{ StringHelper::currency($item->price, true) }}
                                    </td>
                                    <td
                                        class="p-4 text-sm font-normal text-gray-500 whitespace-nowrap dark:text-gray-400">
                                        {{ StringHelper::currency($item->qty) }} item
                                    </td>
                                    <td
                                        class="p-4 text-sm font-normal text-gray-500 whitespace-nowrap dark:text-gray-400">
                                        {{ StringHelper::currency($item->total, true) }}
                                    </td>
                                </tr>
                            @endforeach
                            <tr class="font-bold">
                                <td class="p-4 text-sm bg-gray-100 whitespace-nowrap dark:bg-gray-700" colspan=3>
                                    {{ __('Total All') }}
                                </td>
                                <td class="p-4 text-sm font-normal bg-gray-100 whitespace-nowrap dark:bg-gray-700">
                                    {{ StringHelper::currency($transaction->details->sum('qty')) }} item
                                </td>
                                <td class="p-4 text-sm font-normal bg-gray-100 whitespace-nowrap dark:bg-gray-700">
                                    {{ StringHelper::currency($transaction->details->sum('total'), true) }}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="grid grid-cols-6 gap-3">
            <div class="col-span-6 lg:col-span-3">
                <div class="mb-1 font-bold">
                    {{ __('Payment') }}
                </div>
                @if (
                    $transaction->status != \App\Enums\TransactionStatusType::Canceled &&
                        $transaction?->payment->status == \App\Enums\PaymentStatusType::WaitingForConfirmation)
                    <button type="button" data-modal-toggle="proof-of-payment-modal"
                        data-modal-target="proof-of-payment-modal"
                        class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-orange-700 rounded-lg hover:bg-orange-800 focus:ring-4 focus:ring-orange-300 dark:bg-orange-600 dark:hover:bg-orange-700 dark:focus:ring-orange-800">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-2" viewBox="0 0 24 24">
                            <path fill="currentColor"
                                d="M9 17q.425 0 .713-.288T10 16q0-.425-.288-.713T9 15q-.425 0-.713.288T8 16q0 .425.288.713T9 17Zm3 0q.425 0 .713-.288T13 16q0-.425-.288-.713T12 15q-.425 0-.713.288T11 16q0 .425.288.713T12 17Zm3 0q.425 0 .713-.288T16 16q0-.425-.288-.713T15 15q-.425 0-.713.288T14 16q0 .425.288.713T15 17Zm-4.05-3l5.625-5.65l-1.4-1.425l-4.25 4.25L8.8 9.05l-1.4 1.4L10.95 14ZM12 22q-2.075 0-3.9-.788t-3.175-2.137q-1.35-1.35-2.137-3.175T2 12q0-2.075.788-3.9t2.137-3.175q1.35-1.35 3.175-2.137T12 2q2.075 0 3.9.788t3.175 2.137q1.35 1.35 2.138 3.175T22 12q0 2.075-.788 3.9t-2.137 3.175q-1.35 1.35-3.175 2.138T12 22Zm0-2q3.35 0 5.675-2.325T20 12q0-3.35-2.325-5.675T12 4Q8.65 4 6.325 6.325T4 12q0 3.35 2.325 5.675T12 20Zm0-8Z" />
                        </svg>
                        {{ __('Payment Confirmation') }}
                    </button>
                @else
                    @if ($transaction->status != \App\Enums\TransactionStatusType::Canceled)
                        <div class="mb-4">
                            <div class="mb-1 text-gray-700">
                                {{ __('Payment has been confirmed.') }}
                            </div>
                            <div class="mb-1 text-gray-700">
                                <span class="font-bold">
                                    {{ __('Payment Vendor') }}:
                                </span>
                                <span>{{ $transaction->payment->payment_vendor->name }}</span>
                            </div>
                            <div class="mb-1 text-gray-700">
                                <span class="font-bold">
                                    {{ __('Account Number') }}:
                                </span>
                                <span>
                                    <span>{{ $transaction->payment->payment_vendor->account_number }}</span>
                                </span>
                            </div>
                        </div>
                    @else
                        {{ __('Transaction cannot continue') }}
                    @endif
                    @if (
                        !in_array($transaction->status, [
                            \App\Enums\TransactionStatusType::Completed,
                            \App\Enums\TransactionStatusType::Canceled,
                        ]))
                        <button type="button"
                            wire:confirm="{{ __('Are you sure you want to restore the :feature?', ['feature' => __('payment')]) }}"
                            wire:click="cancel_payment"
                            class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-orange-700 rounded-lg hover:bg-orange-800 focus:ring-4 focus:ring-orange-300 dark:bg-orange-600 dark:hover:bg-orange-700 dark:focus:ring-orange-800">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-2" viewBox="0 0 24 24">
                                <path fill="currentColor"
                                    d="M13 16h-2.75q-.325 0-.537-.213T9.5 15.25q0-.325.213-.537t.537-.213h2.25v-1h-2.25q-.325 0-.537-.213T9.5 12.75v-2q0-.325.213-.537T10.25 10h3q.325 0 .537.213t.213.537q0 .325-.213.537t-.537.213H11v1h2.25q.325 0 .537.213t.213.537V15q0 .425-.288.713T13 16Zm-1 6q-1.875 0-3.513-.713t-2.85-1.924q-1.212-1.213-1.924-2.85T3 13q0-.425.288-.713T4 12q.425 0 .713.288T5 13q0 2.925 2.038 4.963T12 20q2.925 0 4.963-2.038T19 13q0-2.925-2.038-4.963T12 6h-.15l.85.85q.3.3.288.7t-.288.7q-.3.3-.712.313t-.713-.288L8.7 5.7q-.3-.3-.3-.7t.3-.7l2.575-2.575q.3-.3.713-.288t.712.313q.275.3.288.7t-.288.7l-.85.85H12q1.875 0 3.513.713t2.85 1.925q1.212 1.212 1.925 2.85T21 13q0 1.875-.713 3.513t-1.924 2.85q-1.213 1.212-2.85 1.925T12 22Z" />
                            </svg>
                            {{ __('Cancel :cancel', ['cancel' => __('Confirmation')]) }}
                        </button>
                    @endif
                @endif
            </div>
            <div class="col-span-6 lg:col-span-3">
                @if ($transaction->status == \App\Enums\TransactionStatusType::WaitingForConfirmation)
                    <button type="button"
                        wire:confirm="{{ __('Are you sure you want to cancel the :feature?', ['feature' => __('order')]) }}"
                        wire:click="cancel_order"
                        class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-orange-700 rounded-lg hover:bg-orange-800 focus:ring-4 focus:ring-orange-300 dark:bg-orange-600 dark:hover:bg-orange-700 dark:focus:ring-orange-800">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-2" viewBox="0 0 24 24">
                            <path fill="currentColor"
                                d="M14 12H8a1 1 0 0 0 0 2h6a1 1 0 0 0 0-2m5.41 7l1.3-1.29a1 1 0 0 0-1.42-1.42L18 17.59l-1.29-1.3a1 1 0 0 0-1.42 1.42l1.3 1.29l-1.3 1.29a1 1 0 0 0 0 1.42a1 1 0 0 0 1.42 0l1.29-1.3l1.29 1.3a1 1 0 0 0 1.42 0a1 1 0 0 0 0-1.42ZM12 20H6a1 1 0 0 1-1-1V5a1 1 0 0 1 1-1h5v3a3 3 0 0 0 3 3h3v3a1 1 0 0 0 2 0V8.94a1.31 1.31 0 0 0-.06-.27v-.09a1.07 1.07 0 0 0-.19-.28l-6-6a1.07 1.07 0 0 0-.28-.19a.29.29 0 0 0-.1 0a1.1 1.1 0 0 0-.31-.11H6a3 3 0 0 0-3 3v14a3 3 0 0 0 3 3h6a1 1 0 0 0 0-2m1-14.59L15.59 8H14a1 1 0 0 1-1-1ZM8 8a1 1 0 0 0 0 2h1a1 1 0 0 0 0-2Zm4 8H8a1 1 0 0 0 0 2h4a1 1 0 0 0 0-2" />
                        </svg>
                        {{ __('Cancel the order') }}
                    </button>
                @endif
                @if (in_array($transaction->status, [
                        \App\Enums\TransactionStatusType::WaitingForDelivery,
                        \App\Enums\TransactionStatusType::Completed,
                    ]))
                    <livewire:backend.transaction.show.delivery :$transaction />
                @endif
            </div>
        </div>
    </div>

    {{-- PROOF OF PAYMENT MODAL --}}
    @if (
        $transaction->status != \App\Enums\TransactionStatusType::Canceled &&
            $transaction?->payment->status == \App\Enums\PaymentStatusType::WaitingForConfirmation)
        <div class="fixed left-0 right-0 z-50 items-center justify-center hidden overflow-x-hidden overflow-y-auto top-4 md:inset-0 h-modal sm:h-full"
            id="proof-of-payment-modal">
            <div class="relative w-full h-full max-w-2xl px-4 md:h-auto">
                <div class="relative bg-white rounded-lg shadow dark:bg-gray-800">
                    <div class="flex items-start justify-between p-5 border-b rounded-t dark:border-gray-700">
                        <h3 class="text-xl font-semibold dark:text-white">
                            {{ __('Proof of Payment') }}
                        </h3>
                        <button type="button"
                            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-700 dark:hover:text-white"
                            data-modal-toggle="proof-of-payment-modal">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </button>
                    </div>
                    <div class="max-h-[80vh] overflow-y-auto">
                        <div class="p-6 space-y-6">
                            <div class="space-y-1">
                                <div>
                                    <span class="font-bold">
                                        {{ __('Payment Vendor') }}:
                                    </span>
                                    <span> {{ $transaction->payment->payment_vendor->name }}</span>
                                </div>
                                <div>
                                    <span class="font-bold">
                                        {{ __('Account Number') }}:
                                    </span>
                                    <span
                                        class="text-bold">{{ $transaction->payment->payment_vendor->account_number }}</span>
                                </div>
                            </div>
                            <img class="max-w-full mx-auto" src="{{ $transaction->payment->image_path }}"
                                alt="{{ __('Proof of Payment') }} Image">
                        </div>
                    </div>
                    <div class="flex items-center gap-3 p-6 border-t border-gray-200 rounded-b dark:border-gray-700">
                        <button wire:click='confirmation_payment' wire:loading.attr='disabled'
                            class="text-white bg-orange-700 hover:bg-orange-800 focus:ring-4 focus:ring-orange-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-orange-600 dark:hover:bg-orange-700 dark:focus:ring-orange-800"
                            type="button">{{ __('Confirmation') }}
                        </button>
                        <button type="button" data-modal-toggle="proof-of-payment-modal"
                            class="inline-flex justify-center text-gray-500 items-center bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-orange-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">
                            <svg aria-hidden="true" class="w-5 h-5 -ml-1 sm:mr-1" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12">
                                </path>
                            </svg>
                            {{ __('Close') }}
                        </button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    @endif
</div>
