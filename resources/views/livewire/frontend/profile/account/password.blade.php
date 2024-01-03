<div>
    <h4>{{ __('Password') }}</h4>
    <div class="mt-4">
        <form wire:submit='update_user'>
            @csrf
            <div class="mb-4">
                <label class="block mb-1 text-sm text-gray-700" for="password">{{ __('Current Password') }}</label>
                <input type="password" placeholder="{{ __('Current Password') }}" wire:model.live='password'
                    class="focus:shadow-primary-outline text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding p-3 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-orange-950 focus:outline-none" />
                @error('password')
                    <div class="mt-1 ml-2 text-sm text-red-500">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-4">
                <label class="block mb-1 text-sm text-gray-700" for="new_password">{{ __('New Password') }}</label>
                <input type="password" placeholder="{{ __('New Password') }}" wire:model.live='new_password'
                    class="focus:shadow-primary-outline text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding p-3 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-orange-950 focus:outline-none" />
                @error('new_password')
                    <div class="mt-1 ml-2 text-sm text-red-500">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-4">
                <label class="block mb-1 text-sm text-gray-700" for="re_password">{{ __('Re-Password') }}</label>
                <input type="password" placeholder="{{ __('Re-Password') }}" wire:model.live='re_password'
                    class="focus:shadow-primary-outline text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding p-3 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-orange-950 focus:outline-none" />
                @error('re_password')
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
