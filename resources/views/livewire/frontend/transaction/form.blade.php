<div class="p-4 text-white rounded-lg bg-orange-950">
    <div class="space-y-3">
        <div>
            <label class="block mb-1 font-light" for="orderer_name">{{ __('Orderer Name') }}</label>
            <input type="text" placeholder="{{ __('Orderer Name') }}" wire:model='orderer_name'
                class="focus:shadow-primary-outline text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding p-3 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-orange-950 focus:outline-none" />
            @error('orderer_name')
                <div class="mt-1 ml-2 text-sm text-red-500">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div>
            <label class="block mb-1 font-light" for="address">{{ __('Address') }}</label>
            <textarea placeholder="{{ __('Address') }}" wire:model='address'
                class="focus:shadow-primary-outline text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding p-3 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-orange-950 focus:outline-none">
            </textarea>
            @error('address')
                <div class="mt-1 ml-2 text-sm text-red-500">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div>
            <label class="block mb-1 font-light" for="phone_number">{{ __('Phone Number') }}</label>
            <input type="number" placeholder="812345678" wire:model='phone_number'
                class="focus:shadow-primary-outline text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding p-3 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-orange-950 focus:outline-none" />
            @error('phone_number')
                <div class="mt-1 ml-2 text-sm text-red-500">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div>
            <label class="block mb-1 font-light" for="province">{{ __('Province') }}</label>
            <select
                class="focus:shadow-primary-outline text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding p-3 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-orange-950 focus:outline-none"
                wire:model.live='province' wire:change='set_cities($event.target.value)'>
                <option value=0 disabled selected>--{{ __('Please Select') }}--</option>
                @foreach ($provinces as $item)
                    <option value="{{ $item['province_id'] }}">{{ $item['province'] }}</option>
                @endforeach
            </select>
            @error('province')
                <div class="mt-1 ml-2 text-sm text-red-500">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div>
            <label class="block mb-1 font-light" for="city">{{ __('City') }}</label>
            <select
                class="focus:shadow-primary-outline text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding p-3 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-orange-950 focus:outline-none"
                wire:model.live='city' wire:change="set_shipping_cost">
                <option value=0 disabled selected>--{{ __('Please Select') }}--</option>
                @if ($province)
                    @foreach ($cities as $item)
                        <option value="{{ $item['city_id'] }}">{{ $item['city_name'] }}</option>
                    @endforeach
                @endif
            </select>
            @error('city')
                <div class="mt-1 ml-2 text-sm text-red-500">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div>
            <label class="block mb-1 font-light" for="note">{{ __('Note') }}</label>
            <textarea placeholder="{{ __('Note') }} ({{ __('Optional') }})" wire:model='note'
                class="focus:shadow-primary-outline text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding p-3 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-orange-950 focus:outline-none">
            </textarea>
            @error('note')
                <div class="mt-1 ml-2 text-sm text-red-500">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div>
            <div class="mb-1 font-light">
                {{ __('Estimation Delivery') }}
            </div>
            <div class="font-medium">
                {{ $estimation_day > 1 ? __(':day days', ['day' => StringHelper::currency($estimation_day)]) : __(':day day', ['day' => StringHelper::currency($estimation_day)]) }}
            </div>
        </div>
    </div>
    <div class="my-4">
        <table class="w-full font-medium">
            <tbody>
                <tr>
                    <td class="p-2 border-b whitespace-nowrap">
                        {{ __('Subtotal') }}
                    </td>
                    <td class="p-2 border-b text-end whitespace-nowrap">
                        {{ StringHelper::currency($carts->sum(fn($q) => $q->qty * $q->product->final_price)) }}
                    </td>
                </tr>
                <tr>
                    <td class="p-2 border-b whitespace-nowrap">
                        {{ __('Shipping Cost') }}:
                    </td>
                    <td class="p-2 border-b text-end whitespace-nowrap">
                        {{ StringHelper::currency($shipping_cost) }}
                    </td>
                </tr>
                <tr>
                    <td class="p-2 border-b whitespace-nowrap">
                        {{ __('Total Payment') }}
                    </td>
                    <td class="p-2 border-b text-end whitespace-nowrap">
                        {{ StringHelper::currency($carts->sum(fn($q) => $q->qty * $q->product->final_price) + $shipping_cost) }}
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <button
        class="flex items-center justify-center w-full gap-3 py-1 text-center transition-all bg-red-500 rounded-md hover:bg-red-900 px-9"
        wire:click='store_transaction' wire:loading.attr='disabled'
        wire:target="store_transaction,set_shipping_cost,set_cities,set_provinces" @disabled(!$button_enable)>
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 14 14">
            <g fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round">
                <path color="currentColor"
                    d="M6.5 11h1M10 5V3m2-1.25A1.25 1.25 0 0 1 10.75 3h-1.5a1.25 1.25 0 0 1 0-2.5h1.5A1.25 1.25 0 0 1 12 1.75ZM5.5 5V1.5h-3V5" />
                <rect width="13" height="5" x=".5" y="8.5" rx="1" />
                <path d="M12.5 8.5V6a1 1 0 0 0-1-1h-9a1 1 0 0 0-1 1v2.5" />
            </g>
        </svg>
        {{ __('Continue payment') }}
    </button>
</div>
