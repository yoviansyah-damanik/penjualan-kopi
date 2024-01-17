<div>
    <div class="px-4">
        <div
            class="p-4 mb-4 bg-white border border-gray-200 rounded-lg shadow-sm dark:border-gray-700 sm:p-6 dark:bg-gray-800">
            <div class="flex justify-center space-x-3">
                <div class="w-full max-w-xs">
                    <label for="type" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        {{ __('Type') }}
                    </label>
                    <select id="type"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-orange-500 focus:border-orange-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-orange-500 dark:focus:border-orange-500"
                        wire:model.live="type">
                        <option value="monthly">
                            {{ __('Monthly') }}
                        </option>
                        <option value="annual">
                            {{ __('Annual') }}
                        </option>
                    </select>
                    @error('type')
                        <div class="mt-1 text-sm text-red-700">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                @if ($type == 'monthly')
                    <div class="w-full max-w-xs">
                        <label for="month" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            {{ __('Month') }}
                        </label>
                        <select id="month"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-orange-500 focus:border-orange-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-orange-500 dark:focus:border-orange-500"
                            wire:model.live="month">
                            @foreach (range(1, 12) as $item)
                                <option value="{{ $item }}">
                                    {{ Carbon::createFromFormat('m', $item)->translatedFormat('F') }}
                                </option>
                            @endforeach
                        </select>
                        @error('month')
                            <div class="mt-1 text-sm text-red-700">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                @endif
                <div class="w-full max-w-xs">
                    <label for="year" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        {{ __('Year') }}
                    </label>
                    <select id="year"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-orange-500 focus:border-orange-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-orange-500 dark:focus:border-orange-500"
                        wire:model.live="year">
                        @foreach (range(2023, Carbon::now()->year) as $item)
                            <option value="{{ $item }}">
                                {{ $item }}
                            </option>
                        @endforeach
                    </select>
                    @error('year')
                        <div class="mt-1 text-sm text-red-700">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
        </div>

        <livewire:backend.home.notify :$type :$month :$year :$start_date :$end_date />

        <div class="grid grid-cols-3 grid-rows-none gap-4">
            <div class="col-span-3 xl:col-span-1">
                <livewire:backend.home.statistic :$type :$month :$year :$start_date :$end_date />
            </div>
            <div class="col-span-3 xl:col-span-2">
                <livewire:backend.home.sales-chart :$type :$month :$year />
                <livewire:backend.home.income-chart :$type :$month :$year />
            </div>
        </div>

        <livewire:backend.home.sales-statistic :$type :$month :$year :$start_date :$end_date />
        <livewire:backend.home.last-transaction />
    </div>
</div>

@push('scripts')
@endpush
