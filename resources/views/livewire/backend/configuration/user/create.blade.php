<div class="max-h-[85vh] overflow-auto">
    <form wire:submit='store_user'>
        <div class="space-y-4">
            <div>
                <label for="username" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                    {{ __('Username') }}
                </label>
                <input type="text" wire:model='username' id="username"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-orange-600 focus:border-orange-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-orange-500 dark:focus:border-orange-500"
                    required="">
                @error('username')
                    <div class="mt-1 text-sm text-red-700">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div>
                <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                    {{ __('Full Name') }}
                </label>
                <input type="text" wire:model='name' id="name"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-orange-600 focus:border-orange-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-orange-500 dark:focus:border-orange-500"
                    required="">
                @error('name')
                    <div class="mt-1 text-sm text-red-700">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div>
                <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                    {{ __('Email') }}
                </label>
                <input type="email" wire:model='email' id="email"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-orange-600 focus:border-orange-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-orange-500 dark:focus:border-orange-500"
                    required="">
                @error('email')
                    <div class="mt-1 text-sm text-red-700">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div>
                <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                    {{ __('Password') }}
                </label>
                <input type="password" wire:model='password' id="password"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-orange-600 focus:border-orange-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-orange-500 dark:focus:border-orange-500"
                    required="">
                @error('password')
                    <div class="mt-1 text-sm text-red-700">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div>
                <label for="re_password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                    {{ __('Re-Password') }}
                </label>
                <input type="password" wire:model='re_password' id="re_password"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-orange-600 focus:border-orange-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-orange-500 dark:focus:border-orange-500"
                    required="">
                @error('re_password')
                    <div class="mt-1 text-sm text-red-700">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="absolute bottom-0 left-0 flex justify-center w-full px-4 pb-4 space-x-4">
                <button type="submit"
                    class="text-white w-full justify-center bg-orange-700 hover:bg-orange-800 focus:ring-4 focus:outline-none focus:ring-orange-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-orange-600 dark:hover:bg-orange-700 dark:focus:ring-orange-800">
                    {{ __('Add :add', ['add' => __('product')]) }}
                </button>
                <button type="button" data-drawer-dismiss="drawer-create-product-default"
                    aria-controls="drawer-create-product-default"
                    class="inline-flex w-full justify-center text-gray-500 items-center bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-orange-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">
                    <svg aria-hidden="true" class="w-5 h-5 -ml-1 sm:mr-1" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                        </path>
                    </svg>
                    {{ __('Cancel') }}
                </button>
            </div>
        </div>
    </form>
</div>
