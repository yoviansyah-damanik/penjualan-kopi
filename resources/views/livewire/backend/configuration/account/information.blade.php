<div
    class="p-4 bg-white border border-gray-200 rounded-lg shadow-sm 2xl:col-span-2 dark:border-gray-700 sm:p-6 dark:bg-gray-800">
    <h4>{{ __('Account Information') }}</h4>
    <div class="mt-4">
        <form wire:submit='update_user'>
            @csrf
            <div class="mb-4">
                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                    for="username">{{ __('Username') }}</label>
                <input type="text" placeholder="{{ __('Username') }}" wire:model.live='username'
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-orange-600 focus:border-orange-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-orange-500 dark:focus:border-orange-500" />
                @error('username')
                    <div class="mt-1 ml-2 text-sm text-red-500">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-4">
                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                    for="name">{{ __('Full Name') }}</label>
                <input type="text" placeholder="{{ __('Full Name') }}" wire:model.live='name'
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-orange-600 focus:border-orange-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-orange-500 dark:focus:border-orange-500" />
                @error('name')
                    <div class="mt-1 ml-2 text-sm text-red-500">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-4">
                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                    for="email">{{ __('Email') }}</label>
                <input type="text" placeholder="{{ __('Email') }}" wire:model.live='email'
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-orange-600 focus:border-orange-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-orange-500 dark:focus:border-orange-500" />
                @error('email')
                    <div class="mt-1 ml-2 text-sm text-red-500">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <button class="w-full px-4 py-2 text-white rounded-md bg-gradient-to-br from-orange-950 to-red-700"
                type="submit btn-main">
                {{ __('Save') }}
            </button>
        </form>
    </div>
</div>
