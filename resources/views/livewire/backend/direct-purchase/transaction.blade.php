<div>
    <div class="p-4 mx-4 my-6 bg-white rounded-lg shadow md:p-6 xl:p-8 dark:bg-gray-800 dark:text-white">
        <div class="flex flex-col-reverse items-center justify-between mb-5 lg:flex-row">
            <div class="flex-none">
                <div class="text-xl font-bold">
                    #{{ $invoice_number }}
                </div>

            </div>
            <div class="flex-none mb-3 lg:mb-0">
                <span @class([
                    'border',
                    'bg-yellow-100',
                    'border-yellow-300',
                    'rounded-lg',
                    'px-3',
                    'py-1',
                    'text-xs',
                    'font-bold',
                    'dark:text-black',
                ])>
                    {{ __(Str::headline(\App\Enums\TransactionType::DirectPurchase)) }}
                </span>
            </div>
        </div>

        {{-- ITEMS --}}
        <div class="mb-5 overflow-x-auto">
            <div class="inline-block min-w-full align-middle">
                <div class="overflow-hidden shadow">
                    <table class="min-w-full divide-y divide-gray-200 table-fixed dark:divide-gray-600">
                        <thead class="bg-gray-100 dark:bg-gray-700">
                            <tr>
                                <th scope="col"
                                    class="p-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">
                                    #
                                </th>
                                <th scope="col"
                                    class="p-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">
                                </th>
                                <th scope="col"
                                    class="p-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">
                                    {{ __(':name Name', ['name' => __('product')]) }}
                                </th>
                                <th scope="col"
                                    class="p-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">
                                    {{ __('Price') }}
                                </th>
                                <th scope="col"
                                    class="p-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">
                                    {{ __('Quantities') }}
                                </th>
                                <th scope="col"
                                    class="p-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">
                                    {{ __('Total') }}
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-700">
                            @forelse ($product_list as $product)
                                <tr>
                                    <td
                                        class="p-4 text-sm font-normal text-gray-500 whitespace-nowrap dark:text-gray-400">
                                        {{ $loop->iteration }}
                                    </td>
                                    <td class="p-1 text-sm font-normal text-white whitespace-nowrap">
                                        <div class="flex flex-col items-center justify-center gap-1">
                                            <button wire:click='decrement("{{ $product['id'] }}")'
                                                wire:loading.attr='disabled' wire:target='increment,decrement,remove'
                                                class="focus:outline-none transition duration-150 bg-orange-500 rounded-md h-[25px] flex justify-center items-center aspect-square hover:bg-orange-950">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15"
                                                    viewBox="0 0 24 24">
                                                    <path fill="currentColor" d="M4 13v-2h16v2H4Z" />
                                                </svg>
                                            </button>
                                            <button wire:click='increment("{{ $product['id'] }}")'
                                                wire:loading.attr='disabled' wire:target='increment,decrement,remove'
                                                class="focus:outline-none transition duration-150 bg-orange-500 rounded-md h-[25px] flex justify-center items-center aspect-square hover:bg-orange-950">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15"
                                                    viewBox="0 0 24 24">
                                                    <path fill="currentColor" d="M11 13H5v-2h6V5h2v6h6v2h-6v6h-2v-6Z" />
                                                </svg>
                                            </button>
                                            <button wire:click='remove("{{ $product['id'] }}")'
                                                wire:loading.attr='disabled' wire:target='increment,decrement,remove'
                                                class="focus:outline-none transition duration-150 bg-orange-500 rounded-md h-[25px] flex justify-center items-center aspect-square hover:bg-orange-950">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15"
                                                    viewBox="0 0 24 24">
                                                    <path fill="currentColor"
                                                        d="M7 21q-.825 0-1.413-.588T5 19V6H4V4h5V3h6v1h5v2h-1v13q0 .825-.588 1.413T17 21H7Zm2-4h2V8H9v9Zm4 0h2V8h-2v9Z" />
                                                </svg>
                                            </button>
                                        </div>
                                    </td>
                                    <td
                                        class="p-4 text-sm font-normal text-gray-500 whitespace-nowrap dark:text-gray-400">
                                        <div class="text-base font-semibold text-gray-900 underline dark:text-white">
                                            #{{ $product['id'] }}
                                        </div>
                                        <div class="text-base font-semibold text-gray-900 dark:text-white">
                                            {{ $product['name'] }}
                                        </div>
                                        <div class="text-sm font-normal text-gray-500 dark:text-gray-400">
                                            {{ $product['category_name'] }}
                                        </div>
                                    </td>
                                    <td
                                        class="p-4 text-sm font-normal text-gray-500 whitespace-nowrap dark:text-gray-400">
                                        {{ StringHelper::currency($product['final_price'], true) }}
                                    </td>
                                    <td
                                        class="p-4 text-sm font-normal text-gray-500 whitespace-nowrap dark:text-gray-400">
                                        {{ StringHelper::currency($product['qty']) }} item
                                    </td>
                                    <td
                                        class="p-4 text-sm font-normal text-gray-500 whitespace-nowrap dark:text-gray-400">
                                        {{ StringHelper::currency($product['total'], true) }}
                                    </td>
                                </tr>
                            @empty
                                <tr class="hover:bg-gray-100 dark:hover:bg-gray-700">
                                    <td colspan="6" class="p-4 text-center">
                                        <span class="text-gray-700 dark:text-gray-300">
                                            {{ __('No data found.') }}
                                        </span>
                                    </td>
                                </tr>
                            @endforelse
                            <tr class="font-bold">
                                <td class="p-4 text-sm bg-gray-100 whitespace-nowrap dark:bg-gray-700" colspan=4>
                                    {{ __('Total All') }}
                                </td>
                                <td class="p-4 text-sm font-normal bg-gray-100 whitespace-nowrap dark:bg-gray-700">
                                    {{ StringHelper::currency($qty) }} item
                                </td>
                                <td class="p-4 text-sm font-normal bg-gray-100 whitespace-nowrap dark:bg-gray-700">
                                    {{ StringHelper::currency($amount, true) }}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            @error('product_list')
                <div class="mt-1 ml-2 text-sm text-red-500">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="w-full max-w-xl mb-5 space-y-3 ms-auto">
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
            <div class="text-end">
                <button wire:click='store_transaction' wire:loading.attr='disabled'
                    wire:target='increment,decrement,remove,store_transaction'
                    class="text-white justify-center bg-orange-700 hover:bg-orange-800 focus:ring-4 focus:outline-none focus:ring-orange-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-orange-600 dark:hover:bg-orange-700 dark:focus:ring-orange-800">
                    {{ __('Save') }}
                </button>
            </div>
        </div>
    </div>
</div>
