<div class="grid w-full grid-cols-1 gap-4 mt-4 xl:grid-cols-2 2xl:grid-cols-3">
    <div
        class="items-center justify-between p-4 bg-white border border-gray-200 rounded-lg shadow-sm sm:flex dark:border-gray-700 sm:p-6 dark:bg-gray-800">
        <div class="w-full">
            <h3 class="text-base font-normal text-gray-500 dark:text-gray-400">{{ __('Sales') }}</h3>
            <span class="text-2xl font-bold leading-none text-gray-900 sm:text-3xl dark:text-white">
                {{ StringHelper::currency($sales_this_month) }} {{ __('products') }}
            </span>
        </div>
    </div>
    <div
        class="items-center justify-between p-4 bg-white border border-gray-200 rounded-lg shadow-sm sm:flex dark:border-gray-700 sm:p-6 dark:bg-gray-800">
        <div class="w-full">
            <h3 class="text-base font-normal text-gray-500 dark:text-gray-400">{{ __('Total Sales') }}</h3>
            <span class="text-2xl font-bold leading-none text-gray-900 sm:text-3xl dark:text-white">
                {{ StringHelper::currency($total_sales, true) }}
            </span>
        </div>
    </div>
    <div class="p-4 bg-white border border-gray-200 rounded-lg shadow-sm dark:border-gray-700 sm:p-6 dark:bg-gray-800">
        <div class="w-full">
            <h3 class="mb-2 text-base font-normal text-gray-500 dark:text-gray-400">
                {{ __('Transaction Persentage') }}
            </h3>
            <div class="flex items-center mb-2">
                <div class="text-sm font-medium w-28 dark:text-white">
                    {{ __('Waiting For Confirmation') }}
                </div>
                <div class="w-full bg-gray-200 rounded-full h-2.5 dark:bg-gray-700">
                    <div class="bg-yellow-300 h-2.5 rounded-full dark:bg-yellow-200"
                        style="width: {{ $waiting_for_confirmation_transactions != 0 || $total_transactions != 0 ? ($waiting_for_confirmation_transactions / $total_transactions) * 100 : 0 }}%">
                    </div>
                </div>
                <div class="w-16 text-end ms-3">
                    {{ $waiting_for_confirmation_transactions != 0 || $total_transactions != 0 ? ($waiting_for_confirmation_transactions / $total_transactions) * 100 : 0 }}%
                </div>
            </div>
            <div class="flex items-center mb-2">
                <div class="text-sm font-medium w-28 dark:text-white">
                    {{ __('Waiting For Delivery') }}
                </div>
                <div class="w-full bg-gray-200 rounded-full h-2.5 dark:bg-gray-700">
                    <div class="bg-cyan-300 h-2.5 rounded-full dark:bg-cyan-200"
                        style="width: {{ $waiting_for_delivery_transactions != 0 || $total_transactions != 0 ? ($waiting_for_delivery_transactions / $total_transactions) * 100 : 0 }}%">
                    </div>
                </div>
                <div class="w-16 text-end ms-3">
                    {{ $waiting_for_delivery_transactions != 0 || $total_transactions != 0 ? ($waiting_for_delivery_transactions / $total_transactions) * 100 : 0 }}%
                </div>
            </div>
            <div class="flex items-center mb-2">
                <div class="text-sm font-medium w-28 dark:text-white">
                    {{ __('Canceled') }}
                </div>
                <div class="w-full bg-gray-200 rounded-full h-2.5 dark:bg-gray-700">
                    <div class="bg-red-600 h-2.5 rounded-full dark:bg-red-500"
                        style="width: {{ $canceled_transactions != 0 || $total_transactions != 0 ? ($canceled_transactions / $total_transactions) * 100 : 0 }}%">
                    </div>
                </div>
                <div class="w-16 text-end ms-3">
                    {{ $canceled_transactions != 0 || $total_transactions != 0 ? ($canceled_transactions / $total_transactions) * 100 : 0 }}%
                </div>
            </div>
            <div class="flex items-center mb-2">
                <div class="text-sm font-medium w-28 dark:text-white">
                    {{ __('Completed') }}
                </div>
                <div class="w-full bg-gray-200 rounded-full h-2.5 dark:bg-gray-700">
                    <div class="bg-green-600 h-2.5 rounded-full dark:bg-green-500"
                        style="width: {{ $completed_transactions != 0 || $total_transactions != 0 ? ($completed_transactions / $total_transactions) * 100 : 0 }}%">
                    </div>
                </div>
                <div class="w-16 text-end ms-3">
                    {{ $completed_transactions != 0 || $total_transactions != 0 ? ($completed_transactions / $total_transactions) * 100 : 0 }}%
                </div>
            </div>
        </div>
    </div>
</div>
