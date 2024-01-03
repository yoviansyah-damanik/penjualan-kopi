<div class="p-4 mt-4 bg-white border border-gray-200 rounded-lg shadow-sm dark:border-gray-700 sm:p-6 dark:bg-gray-800">
    <div class="items-center justify-between lg:flex">
        <div class="mb-4 lg:mb-0">
            <h3 class="mb-2 text-xl font-bold text-gray-900 dark:text-white">{{ __('Transactions') }}</h3>
            <span class="text-base font-normal text-gray-500 dark:text-gray-400">
                {{ __('This is a list of latest transactions') }}</span>
        </div>
        <div class="items-center sm:flex">
            <div class="flex items-center">
                <button id="dropdownDefault" data-dropdown-toggle="dropdown"
                    class="mb-4 sm:mb-0 mr-4 inline-flex items-center text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 font-medium rounded-lg text-sm px-4 py-2.5 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700"
                    type="button">
                    {{ __('Filter by status') }}
                    <svg class="w-4 h-4 ml-2" aria-hidden="true" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </button>
                <div id="dropdown" class="z-10 hidden w-56 p-3 bg-white rounded-lg shadow dark:bg-gray-700"
                    data-popper-placement="bottom"
                    style="position: absolute; inset: 0px auto auto 0px; margin: 0px; transform: translate(793px, 3260px);">
                    <h6 class="mb-3 text-sm font-medium text-gray-900 dark:text-white">
                        {{ __('Status') }}
                    </h6>
                    <ul class="space-y-2 text-sm" aria-labelledby="dropdownDefault">
                        @foreach ($filter_status as $filter)
                            <li class="flex items-center">
                                <input id="{{ $filter }}" type="checkbox" value="{{ $filter }}"
                                    wire:model.live.debounce.500ms="status"
                                    class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-primary-500 dark:focus:ring-primary-600 dark:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                <label for="{{ $filter }}"
                                    class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-100">
                                    {{ __(Str::headline($filter)) }}
                                </label>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="flex flex-col mt-6">
        <div class="overflow-x-auto rounded-lg">
            <div class="inline-block min-w-full align-middle">
                <div class="overflow-hidden shadow sm:rounded-lg">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-600">
                        <thead class="bg-gray-50 dark:bg-gray-700">
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
                                    {{ __('Action') }}
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-gray-800">
                            @forelse ($transactions as $transaction)
                                <tr class="hover:bg-gray-100 dark:hover:bg-gray-700">
                                    <td
                                        class="p-4 text-sm font-normal text-gray-500 whitespace-nowrap dark:text-gray-400">
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
                                    <td
                                        class="p-4 text-sm font-normal text-gray-500 whitespace-nowrap dark:text-gray-400">
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
            </div>
        </div>
    </div>
    <div class="flex items-center justify-between pt-3 sm:pt-6">
        <div>
            <button
                class="inline-flex items-center p-2 text-sm font-medium text-center text-gray-500 rounded-lg hover:text-gray-900 dark:text-gray-400 dark:hover:text-white"
                type="button" data-dropdown-toggle="transactions-dropdown">
                {{ __(Str::headline($date)) }}
                <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
                    </path>
                </svg>
            </button>
            <div class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded shadow dark:bg-gray-700 dark:divide-gray-600"
                id="transactions-dropdown" data-popper-placement="bottom">
                <ul class="py-1" role="none">
                    @foreach ($filter_date as $filter)
                        <li>
                            <button wire:click="set_date('{{ $filter }}')"
                                class="block w-full px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-600 dark:hover:text-white"
                                role="menuitem">{{ __(Str::headline($filter)) }}</button>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="flex-shrink-0">
            <a href="{{ route('dashboard.report.transaction') }}"
                class="inline-flex items-center p-2 text-xs font-medium uppercase rounded-lg text-primary-700 sm:text-sm dark:text-white hover:bg-gray-100 dark:text-primary-500 dark:hover:bg-gray-700">
                {{ __('Transactions Report') }}
                <svg class="w-4 h-4 ml-1 sm:w-5 sm:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7">
                    </path>
                </svg>
            </a>
        </div>
    </div>
</div>
