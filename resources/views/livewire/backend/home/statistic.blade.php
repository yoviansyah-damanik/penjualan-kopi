<div class="p-4 bg-white border border-gray-200 rounded-lg shadow-sm dark:border-gray-700 sm:p-6 dark:bg-gray-800">
    <h3 class="flex items-center mb-4 text-lg font-semibold text-gray-900 dark:text-white">
        {{ __('Statistics') }}
        <button data-popover-target="popover-description" data-popover-placement="bottom-end" type="button"><svg
                class="w-4 h-4 ml-2 text-gray-400 hover:text-gray-500" aria-hidden="true" fill="currentColor"
                viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd"
                    d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-3a1 1 0 00-.867.5 1 1 0 11-1.731-1A3 3 0 0113 8a3.001 3.001 0 01-2 2.83V11a1 1 0 11-2 0v-1a1 1 0 011-1 1 1 0 100-2zm0 8a1 1 0 100-2 1 1 0 000 2z"
                    clip-rule="evenodd"></path>
            </svg><span class="sr-only">{{ __('Show :show', ['show' => __('information')]) }}</span></button>
    </h3>
    <div data-popover="" id="popover-description" role="tooltip"
        class="absolute z-10 invisible inline-block text-sm font-light text-gray-500 transition-opacity duration-300 bg-white border border-gray-200 rounded-lg shadow-sm opacity-0 w-72 dark:bg-gray-800 dark:border-gray-600 dark:text-gray-400"
        data-popper-placement="bottom-end"
        style="position: absolute; inset: 0px 0px auto auto; margin: 0px; transform: translate(-355px, 81px);">
        <div class="p-3 space-y-2">
            <h3 class="font-semibold text-gray-900 dark:text-white">{{ __('Statistics') }}</h3>
            <p>
                {{ __('These statistics help you to develop your product sales potential.') }}
            </p>
        </div>
    </div>
    <ul class="hidden text-sm font-medium text-center text-gray-500 divide-x divide-gray-200 rounded-lg sm:flex dark:divide-gray-600 dark:text-gray-400"
        id="fullWidthTab" data-tabs-toggle="#fullWidthTabContent" role="tablist">
        <li class="w-full">
            <button id="faq-tab" data-tabs-target="#faq" type="button" role="tab" aria-controls="faq"
                aria-selected="true"
                class="inline-block w-full p-4 text-blue-600 border-blue-600 rounded-tl-lg bg-gray-50 hover:bg-gray-100 focus:outline-none dark:bg-gray-700 dark:hover:bg-gray-600 hover:text-blue-600 dark:text-blue-500 dark:hover:text-blue-500 dark:border-blue-500">
                {{ __('Top Products') }}</button>
        </li>
        <li class="w-full">
            <button id="about-tab" data-tabs-target="#about" type="button" role="tab" aria-controls="about"
                aria-selected="false"
                class="inline-block w-full p-4 text-gray-500 border-gray-100 rounded-tr-lg bg-gray-50 hover:bg-gray-100 focus:outline-none dark:bg-gray-700 dark:hover:bg-gray-600 dark:border-transparent hover:text-gray-600 dark:text-gray-400 hover:border-gray-300 dark:border-gray-700 dark:hover:text-gray-300">
                {{ __('Top Customers') }}</button>
        </li>
    </ul>
    <div id="fullWidthTabContent" class="border-t border-gray-200 dark:border-gray-600">
        <div class="pt-4" id="faq" role="tabpanel" aria-labelledby="faq-tab">
            <ul role="list" class="divide-y divide-gray-200 dark:divide-gray-700">
                @foreach ($top_products as $product)
                    <li class="py-3 sm:py-4">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center min-w-0">
                                <img class="flex-shrink-0 w-10 h-10" src="{{ $product->main_image_path }}"
                                    alt="{{ $product->name }} Image">
                                <div class="ml-3">
                                    <p class="font-medium text-gray-900 truncate dark:text-white">
                                        {{ $product->name }}
                                    </p>
                                    <span class="text-sm italic text-gray-500">{{ $product->category_name }}</span>
                                </div>
                            </div>
                            <div
                                class="inline-flex items-center text-sm italic font-semibold text-gray-900 dark:text-white">
                                {{ __(':count purchases', ['count' => StringHelper::currency($product->successfulTransactionCount) . 'x']) }}
                            </div>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
        <div class="hidden pt-4" id="about" role="tabpanel" aria-labelledby="about-tab">
            <ul role="list" class="divide-y divide-gray-200 dark:divide-gray-700">
                @foreach ($top_users as $user)
                    <li class="py-3 sm:py-4">
                        <div class="flex items-center space-x-4">
                            <div class="flex-shrink-0">
                                <img class="w-8 h-8 rounded-full" src="{{ $user['image_path'] }}"
                                    alt="{{ $user['name'] }} image">
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="font-medium text-gray-900 truncate dark:text-white">
                                    {{ $user['name'] }}
                                </p>
                                <p class="text-sm text-gray-500 truncate dark:text-gray-400">
                                    {{ $user['email'] }}
                                </p>
                            </div>
                            <div class="items-center text-base text-gray-900 text-end dark:text-white">
                                <div class="font-semibold">
                                    {{ StringHelper::currency($user['purchase_amount'], true) }}
                                </div>
                                <div class="text-sm italic font-light">
                                    {{ __(':number successful transactions', ['number' => StringHelper::currency($user['number_of_successful_transactions'])]) }}
                                </div>
                            </div>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
