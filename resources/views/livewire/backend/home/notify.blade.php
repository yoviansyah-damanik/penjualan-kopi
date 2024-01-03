<div class="grid w-full grid-cols-1 gap-4 mt-4 mb-4 xl:grid-cols-2 2xl:grid-cols-4">
    <div
        class="items-center justify-between p-4 border border-yellow-200 rounded-lg shadow-sm bg-gradient-to-br from-yellow-400 to-yellow-200 sm:flex dark:border-yellow-700 sm:p-6 dark:bg-yellow-800">
        <div class="w-full">
            <h3 class="text-base font-semibold text-yellow-900 dark:text-yellow-800">{{ __('Waiting For Confirmation') }}
            </h3>
            <span class="text-2xl font-bold leading-none text-yellow-900 sm:text-3xl dark:text-white">
                {{ StringHelper::currency($waiting_for_confirmation_transactions) }}
            </span>
        </div>
    </div>
    <div
        class="items-center justify-between p-4 border rounded-lg shadow-sm border-cyan-200 bg-gradient-to-br from-cyan-400 to-cyan-200 sm:flex dark:border-cyan-700 sm:p-6 dark:bg-cyan-800">
        <div class="w-full">
            <h3 class="text-base font-semibold text-cyan-900 dark:text-cyan-800">{{ __('Waiting For Delivery') }}
            </h3>
            <span class="text-2xl font-bold leading-none text-cyan-900 sm:text-3xl dark:text-white">
                {{ StringHelper::currency($waiting_for_delivery_transactions) }}
            </span>
        </div>
    </div>
    <div
        class="items-center justify-between p-4 border border-red-200 rounded-lg shadow-sm bg-gradient-to-br from-red-400 to-red-200 sm:flex dark:border-red-700 sm:p-6 dark:bg-red-800">
        <div class="w-full">
            <h3 class="text-base font-semibold text-red-900 dark:text-red-800">{{ __('Canceled') }}</h3>
            <span class="text-2xl font-bold leading-none text-red-900 sm:text-3xl dark:text-white">
                {{ StringHelper::currency($canceled_transactions) }}
            </span>
        </div>
    </div>
    <div
        class="items-center justify-between p-4 border border-green-200 rounded-lg shadow-sm bg-gradient-to-br from-green-400 to-green-200 sm:flex dark:border-green-700 sm:p-6 dark:bg-green-800">
        <div class="w-full">
            <h3 class="text-base font-semibold text-green-900 dark:text-green-800">{{ __('Completed') }}</h3>
            <span class="text-2xl font-bold leading-none text-green-900 sm:text-3xl dark:text-white">
                {{ StringHelper::currency($completed_transactions) }}
            </span>
        </div>
    </div>
</div>
