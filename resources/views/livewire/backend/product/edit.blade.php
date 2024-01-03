<div class="max-h-[85vh] overflow-auto">
    <form wire:submit='update_product'>
        <div class="space-y-4">
            <div>
                <label for="main_image" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                    {{ __('Main Image') }}
                </label>
                <input type="file" wire:model='main_image' id="main_image" accept="image/*"
                    class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-orange-600 focus:border-orange-600 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-orange-500 dark:focus:border-orange-500">
                @error('main_image')
                    <div class="mt-1 text-sm text-red-700">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div>
                <label for="additional_images" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                    {{ __('Additional Image') }}
                </label>
                <input type="file" wire:model='additional_images' id="additional_images" multiple="true"
                    accept="image/*"
                    class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-orange-600 focus:border-orange-600 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-orange-500 dark:focus:border-orange-500">
                @error('additional_images')
                    <div class="mt-1 text-sm text-red-700">
                        {{ $message }}
                    </div>
                @enderror
                @error('additional_images.*')
                    <div class="mt-1 text-sm text-red-700">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div>
                <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                    {{ __(':name Name', ['name' => __('Product')]) }}
                </label>
                <input type="text" wire:model='name' id="name"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-orange-600 focus:border-orange-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-orange-500 dark:focus:border-orange-500"
                    placeholder="Kopi Wine Specialty" required="">
                @error('name')
                    <div class="mt-1 text-sm text-red-700">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div>
                <label for="weight" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                    {{ __('Weight') }} (gram)
                </label>
                <input type="text" wire:model='weight' id="weight"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-orange-600 focus:border-orange-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-orange-500 dark:focus:border-orange-500"
                    placeholder="Kopi Wine Specialty" required="">
                @error('weight')
                    <div class="mt-1 text-sm text-red-700">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="flex gap-3">
                <div>
                    <label for="price" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        {{ __('Price') }}
                    </label>
                    <input type="number" wire:model.live.debounce.500ms="price" id="price"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-orange-600 focus:border-orange-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-orange-500 dark:focus:border-orange-500"
                        placeholder="19999" required="">
                    @error('price')
                        <div class="mt-1 text-sm text-red-700">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div>
                    <label for="discount-create"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Discount') }}</label>
                    <input type="number" wire:model.live.debounce.500ms="discount" id="discount"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-orange-600 focus:border-orange-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-orange-500 dark:focus:border-orange-500"
                        placeholder="0" required="">
                    @error('discount')
                        <div class="mt-1 text-sm text-red-700">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
            <div>
                <label for="cost" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                    {{ __('Cost') }}
                </label>
                <input type="number" wire:model.live.debounce.500ms="cost" id="cost"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-orange-600 focus:border-orange-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-orange-500 dark:focus:border-orange-500"
                    placeholder="19999" required="">
                @error('cost')
                    <div class="mt-1 text-sm text-red-700">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="py-2 text-xs font-medium uppercase border-t border-b">
                <div class="flex justify-between">
                    <span>{{ __('Selling Price') }}</span>
                    <span>{{ StringHelper::currency($price - $discount, true) }}</span>
                </div>
                <div class="flex justify-between">
                    <span>{{ __('Profit') }}</span>
                    <span>{{ StringHelper::currency($price - $discount - $cost, true) }}</span>
                </div>
            </div>
            <div>
                <label for="category-create" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                    {{ __('Category') }}
                </label>
                <select id="category-create" wire:model="category"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-orange-500 focus:border-orange-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-orange-500 dark:focus:border-orange-500">
                    <option selected="" value=0>{{ __('Uncategorized') }}</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
                @error('category')
                    <div class="mt-1 text-sm text-red-700">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div>
                <label for="description"
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Description') }}</label>
                <textarea id="description" wire:model="description" rows="4"
                    class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-orange-500 focus:border-orange-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-orange-500 dark:focus:border-orange-500"
                    placeholder="Deskripsi kopi"></textarea>
                @error('description')
                    <div class="mt-1 text-sm text-red-700">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div>
                <label for="status-create" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                    {{ __('Status') }}
                </label>
                <select id="status-create" wire:model="status"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-orange-500 focus:border-orange-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-orange-500 dark:focus:border-orange-500">
                    <option selected="" value=1>{{ __('Available') }}</option>
                    <option value=0>{{ __('Unavailable') }}</option>
                </select>
                @error('status')
                    <div class="mt-1 text-sm text-red-700">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="absolute bottom-0 left-0 flex justify-center w-full px-4 pb-4 space-x-4">
                <button type="submit"
                    class="text-white w-full justify-center bg-orange-700 hover:bg-orange-800 focus:ring-4 focus:outline-none focus:ring-orange-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-orange-600 dark:hover:bg-orange-700 dark:focus:ring-orange-800">
                    {{ __('Update :update', ['update' => __('product')]) }}
                </button>
                <button type="button" data-drawer-dismiss="drawer-create-product-default"
                    aria-controls="drawer-create-product-default"
                    class="inline-flex w-full justify-center text-gray-500 items-center bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-orange-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">
                    <svg aria-hidden="true" class="w-5 h-5 -ml-1 sm:mr-1" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12">
                        </path>
                    </svg>
                    {{ __('Cancel') }}
                </button>
            </div>
        </div>
    </form>
</div>
