<div
    class="p-4 mb-4 bg-white border border-gray-200 rounded-lg shadow-sm 2xl:col-span-2 dark:border-gray-700 sm:p-6 dark:bg-gray-800">
    <div class="space-y-3">
        <div>
            <label for="type" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                {{ __('Type') }}
            </label>
            <select id="type"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-orange-500 focus:border-orange-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-orange-500 dark:focus:border-orange-500"
                wire:model.live="type">
                <option value="monthly">
                    {{ __('Monthly') }}
                </option>
                <option value="annual_recap">
                    {{ __('Annual Recap') }}
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
            <div>
                <label for="month" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                    {{ __('Month') }}
                </label>
                <select id="month"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-orange-500 focus:border-orange-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-orange-500 dark:focus:border-orange-500"
                    wire:model="month">
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
        <div>
            <label for="year" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                {{ __('Year') }}
            </label>
            <select id="year"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-orange-500 focus:border-orange-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-orange-500 dark:focus:border-orange-500"
                wire:model="year">
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
    <div class="mt-7 text-end">
        <button wire:click="preview" wire:loading.attr="disabled" wire:target="preview,print"
            class="text-white justify-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
            {{ __('Preview') }}
        </button>
        <button wire:click="print" wire:loading.attr="disabled" wire:target="preview,print"
            class="text-white justify-center bg-orange-700 hover:bg-orange-800 focus:ring-4 focus:outline-none focus:ring-orange-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-orange-600 dark:hover:bg-orange-700 dark:focus:ring-orange-800">
            {{ __('Print') }}
        </button>
    </div>
</div>
