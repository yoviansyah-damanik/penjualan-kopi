<div>
    <div class="px-4 mb-3">
        <div class="items-center justify-between block sm:flex md:divide-x md:divide-gray-100 dark:divide-gray-700">
            <div class="relative flex-none w-full mt-1 mb-3 lg:w-48 sm:w-64 xl:w-96">
                <input type="text" wire:change="resetPage" wire:model.live='search'
                    class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-orange-950 focus:border-orange-950 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-orange-950 dark:focus:border-orange-950"
                    placeholder="{{ __('Search for :search by :1 or :2', ['search' => __('transactions'), '1' => 'id', '2' => __(':name name', ['name' => __('transaction')])]) }}">
                <button wire:click='clear_search'
                    class="absolute text-gray-300 duration-75 -translate-y-1/2 hover:text-gray-700 top-1/2 right-1">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24">
                        <path fill="currentColor"
                            d="m7.825 12l3.875 3.9q.275.275.288.688t-.288.712q-.275.275-.7.275t-.7-.275l-4.6-4.6q-.15-.15-.213-.325T5.425 12q0-.2.063-.375T5.7 11.3l4.6-4.6q.275-.275.688-.287t.712.287q.275.275.275.7t-.275.7L7.825 12Zm6.6 0l3.875 3.9q.275.275.288.688t-.288.712q-.275.275-.7.275t-.7-.275l-4.6-4.6q-.15-.15-.213-.325T12.026 12q0-.2.063-.375t.212-.325l4.6-4.6q.275-.275.688-.287t.712.287q.275.275.275.7t-.275.7L14.425 12Z" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <div class="overflow-x-auto">
        <div class="inline-block min-w-full align-middle">
            <div class="overflow-hidden shadow">
                <table class="min-w-full divide-y divide-gray-200 table-fixed dark:divide-gray-600">
                    <thead class="bg-gray-100 dark:bg-gray-700">
                        <tr>
                            <th scope="col"
                                class="p-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">
                                {{ __(':info Information', ['info' => __('Transaction')]) }}
                            </th>
                            <th scope="col"
                                class="p-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">
                                {{ __('Customer') }}
                            </th>
                            <th scope="col"
                                class="p-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">
                                {{ __(':detail Details', ['detail' => __('Order')]) }}
                            </th>
                            <th scope="col"
                                class="p-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">
                                {{ __(':info Information', ['info' => __('Shipping')]) }}
                            </th>
                            <th scope="col"
                                class="p-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">
                                {{ __('Total Payment') }}
                            </th>
                            <th scope="col"
                                class="p-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">
                                {{ __('Status') }}
                            </th>
                            <th scope="col"
                                class="p-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">
                                {{ __('Type') }}
                            </th>
                            <th scope="col"
                                class="p-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">
                                {{ __('Actions') }}
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-700">
                        @forelse ($transactions as $transaction)
                            <tr class="hover:bg-gray-100 dark:hover:bg-gray-700">
                                <td class="p-4 text-sm font-normal text-gray-500 whitespace-nowrap dark:text-gray-400">
                                    <div class="text-base font-semibold text-gray-900 underline dark:text-white">
                                        #{{ $transaction->id }}
                                    </div>
                                    <div class="text-base font-semibold text-gray-900 dark:text-white">
                                        {{ __('Unique Code') }}: {{ $transaction->unique_code }}
                                    </div>
                                    <div class="text-sm font-normal text-gray-500 dark:text-gray-400">
                                        {{ $transaction->created_at->translatedFormat('d F Y H:i:s') }}
                                    </div>
                                </td>
                                <td class="p-4 text-base text-gray-900 whitespace-nowrap dark:text-white">
                                    <div class="flex gap-3">
                                        <div class="w-16">
                                            <img class="w-full" src="{{ $transaction->user->image_path }}"
                                                alt="{{ $transaction->user->name }} Image">
                                        </div>
                                        <div>
                                            <div class="font-medium">
                                                {{ $transaction->user->name }}
                                            </div>
                                            <div class="font-light">
                                                {{ __(':type Transaction', ['type' => __('completed')]) }}:
                                                {{ StringHelper::currency($transaction->user->transactions()->status(\App\Enums\TransactionStatusType::Completed)->count()) }}
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="p-4 text-sm font-normal text-gray-500 whitespace-nowrap dark:text-gray-400">
                                    <div class="text-base font-medium text-gray-900 dark:text-white">
                                        {{ StringHelper::currency($transaction->total_payment_products_only, true) }}
                                    </div>
                                    <div class="text-sm font-normal text-gray-500 dark:text-gray-400">
                                        {{ StringHelper::currency($transaction->details->sum('qty')) }} item
                                    </div>
                                    <div class="text-sm font-normal text-gray-500 dark:text-gray-400">
                                        {{ StringHelper::currency($transaction->shipping->weight) }} gram
                                    </div>
                                </td>
                                <td class="p-4 text-base text-gray-900 whitespace-nowrap dark:text-white">
                                    <div class="text-base font-medium text-gray-900 dark:text-white">
                                        {{ $transaction->orderer_name }}
                                    </div>
                                    <div class="text-sm font-normal text-gray-500 dark:text-gray-400">
                                        {{ $transaction->shipping->origin }} - {{ $transaction->shipping->city }}
                                    </div>
                                    <div class="text-xs font-light text-gray-900 dark:text-white">
                                        {{ $transaction->address }}
                                    </div>
                                </td>
                                <td class="p-4 text-base text-gray-900 whitespace-nowrap dark:text-white">
                                    <div class="-space-y-1 text-sm">
                                        <div>
                                            <span class="font-medium">
                                                {{ __('Order') }}:
                                            </span>
                                            <span>
                                                {{ StringHelper::currency($transaction->total_payment_products_only, true) }}
                                            </span>
                                        </div>
                                        <div>
                                            <span class="font-medium">
                                                {{ __('Unique Code') }}:
                                            </span>
                                            <span>
                                                {{ StringHelper::currency($transaction->unique_code) }}
                                            </span>
                                        </div>
                                        <div>
                                            <span class="font-medium">
                                                {{ __('Shipping Cost') }}:
                                            </span>
                                            <span>
                                                {{ StringHelper::currency($transaction->shipping->cost, true) }}
                                            </span>
                                        </div>
                                        <div>
                                            <span class="font-medium">
                                                {{ __('Total') }}:
                                            </span>
                                            <span>
                                                {{ StringHelper::currency($transaction->total_payment, true) }}
                                            </span>
                                        </div>
                                    </div>
                                </td>
                                <td class="p-4 text-base text-gray-900 whitespace-nowrap dark:text-white">
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
                                        'dark:text-black',
                                    ])>
                                        {{ __(Str::headline($transaction->status)) }}
                                    </span>
                                </td>
                                <td class="p-4 text-base text-gray-900 whitespace-nowrap dark:text-white">
                                    <span @class([
                                        'border',
                                        'bg-yellow-100' =>
                                            $transaction->type == \App\Enums\TransactionType::Ecommerce,
                                        'bg-cyan-100' =>
                                            $transaction->type == \App\Enums\TransactionType::DirectPurchase,
                                        'border-yellow-300' =>
                                            $transaction->type == \App\Enums\TransactionType::Ecommerce,
                                        'border-cyan-300' =>
                                            $transaction->type == \App\Enums\TransactionType::DirectPurchase,
                                        'rounded-lg',
                                        'px-3',
                                        'py-1',
                                        'text-xs',
                                        'font-bold',
                                        'dark:text-black',
                                    ])>
                                        {{ __(Str::headline($transaction->type)) }}
                                    </span>
                                </td>
                                <td class="p-4 space-x-2 whitespace-nowrap">
                                    <a href="{{ route('dashboard.transaction.show', base64_encode($transaction->id)) }}"
                                        class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-yellow-700 rounded-lg hover:bg-yellow-800 focus:ring-4 focus:ring-yellow-300 dark:bg-yellow-600 dark:hover:bg-yellow-700 dark:focus:ring-yellow-800">
                                        <svg class="w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 24 24">
                                            <path fill="currentColor"
                                                d="M12 16q1.875 0 3.188-1.313T16.5 11.5q0-1.875-1.313-3.188T12 7q-1.875 0-3.188 1.313T7.5 11.5q0 1.875 1.313 3.188T12 16Zm0-1.8q-1.125 0-1.913-.788T9.3 11.5q0-1.125.788-1.913T12 8.8q1.125 0 1.913.788T14.7 11.5q0 1.125-.787 1.913T12 14.2Zm0 4.8q-3.65 0-6.65-2.038T1 11.5q1.35-3.425 4.35-5.463T12 4q3.65 0 6.65 2.038T23 11.5q-1.35 3.425-4.35 5.463T12 19Zm0-7.5Zm0 5.5q2.825 0 5.188-1.488T20.8 11.5q-1.25-2.525-3.613-4.013T12 6Q9.175 6 6.812 7.488T3.2 11.5q1.25 2.525 3.613 4.013T12 17Z" />
                                        </svg>
                                        {{ __('Show') }}
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr class="hover:bg-gray-100 dark:hover:bg-gray-700">
                                <td colspan="9" class="p-4 text-center">
                                    <span class="text-gray-700 dark:text-gray-300">
                                        {{ __('No data found.') }}
                                    </span>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if ($transactions)
                <div class="px-4 mt-7">
                    {{ $transactions->links() }}
                </div>
            @endif
        </div>
    </div>
</div>
