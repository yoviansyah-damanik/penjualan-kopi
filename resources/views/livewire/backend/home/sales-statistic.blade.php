<div>
    <div class="grid w-full grid-cols-1 gap-4 mt-4 xl:grid-cols-4">
        <div class="grid w-full grid-cols-1 col-span-3 gap-4 mt-4 xl:grid-cols-2">
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
            <div
                class="items-center justify-between p-4 bg-white border border-gray-200 rounded-lg shadow-sm sm:flex dark:border-gray-700 sm:p-6 dark:bg-gray-800">
                <div class="w-full">
                    <h3 class="text-base font-normal text-gray-500 dark:text-gray-400">{{ __('Capital') }}</h3>
                    <span class="text-2xl font-bold leading-none text-gray-900 sm:text-3xl dark:text-white">
                        {{ StringHelper::currency($cost_this_month, true) }}
                    </span>
                </div>
            </div>
            <div
                class="items-center justify-between p-4 bg-white border border-gray-200 rounded-lg shadow-sm sm:flex dark:border-gray-700 sm:p-6 dark:bg-gray-800">
                <div class="w-full">
                    <h3 class="text-base font-normal text-gray-500 dark:text-gray-400">{{ __('Net') }}</h3>
                    <span class="text-2xl font-bold leading-none text-gray-900 sm:text-3xl dark:text-white">
                        {{ StringHelper::currency($total_net, true) }}
                    </span>
                </div>
            </div>
        </div>
        <div
            class="w-full col-span-1 p-4 bg-white border border-gray-200 rounded-lg shadow-sm dark:border-gray-700 sm:p-6 dark:bg-gray-800">
            <h3 class="mb-2 text-base font-normal text-gray-500 dark:text-gray-400">
                {{ __('Transaction Persentage') }}
            </h3>
            <div class="flex items-center mb-2">
                <div class="text-sm font-medium w-28 dark:text-white">
                    {{ __('Waiting For Confirmation') }}
                </div>
                <div class="w-full h-4 bg-gray-200 rounded-full dark:bg-gray-700">
                    <div class="h-4 text-xs text-gray-700 bg-yellow-300 rounded-full dark:bg-yellow-200 text-end pe-2 min-w-[2rem]"
                        style="width: {{ $waiting_for_confirmation_transactions != 0 || $total_transactions != 0 ? ($waiting_for_confirmation_transactions / $total_transactions) * 100 : 0 }}%">
                        {{ $waiting_for_confirmation_transactions != 0 || $total_transactions != 0 ? ($waiting_for_confirmation_transactions / $total_transactions) * 100 : 0 }}%
                    </div>
                </div>
            </div>
            <div class="flex items-center mb-2">
                <div class="text-sm font-medium w-28 dark:text-white">
                    {{ __('Waiting For Delivery') }}
                </div>
                <div class="w-full h-4 bg-gray-200 rounded-full dark:bg-gray-700">
                    <div class="h-4 text-xs text-gray-700 rounded-full bg-cyan-300 dark:bg-cyan-200 text-end pe-2 min-w-[2rem]"
                        style="width: {{ $waiting_for_delivery_transactions != 0 || $total_transactions != 0 ? ($waiting_for_delivery_transactions / $total_transactions) * 100 : 0 }}%">
                        {{ $waiting_for_delivery_transactions != 0 || $total_transactions != 0 ? ($waiting_for_delivery_transactions / $total_transactions) * 100 : 0 }}%
                    </div>
                </div>
            </div>
            <div class="flex items-center mb-2">
                <div class="text-sm font-medium w-28 dark:text-white">
                    {{ __('Canceled') }}
                </div>
                <div class="w-full h-4 bg-gray-200 rounded-full dark:bg-gray-700">
                    <div class="h-4 text-xs text-gray-700 bg-red-300 rounded-full dark:bg-red-200 text-end pe-2 min-w-[2rem]"
                        style="width: {{ $canceled_transactions != 0 || $total_transactions != 0 ? ($canceled_transactions / $total_transactions) * 100 : 0 }}%">
                        {{ $canceled_transactions != 0 || $total_transactions != 0 ? ($canceled_transactions / $total_transactions) * 100 : 0 }}%
                    </div>
                </div>
            </div>
            <div class="flex items-center mb-2">
                <div class="text-sm font-medium w-28 dark:text-white">
                    {{ __('Completed') }}
                </div>
                <div class="w-full h-4 bg-gray-200 rounded-full dark:bg-gray-700">
                    <div class="h-4 text-xs text-gray-700 bg-green-300 rounded-full dark:bg-green-200 text-end pe-2 min-w-[2rem]"
                        style="width: {{ $completed_transactions != 0 || $total_transactions != 0 ? ($completed_transactions / $total_transactions) * 100 : 0 }}%">
                        {{ $completed_transactions != 0 || $total_transactions != 0 ? ($completed_transactions / $total_transactions) * 100 : 0 }}%
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
