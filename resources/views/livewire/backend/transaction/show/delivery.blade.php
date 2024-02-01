<div>
    @if ($transaction->delivery)
        <div class="mb-1 font-bold">
            {{ __('Delivery') }}
        </div>
        <div class="mb-1 text-gray-700 dark:text-gray-100">
            {{ __('Delivery has been made. Customers can access delivery history via the link below.') }}
        </div>
        <a class="italic font-light hover:underline" href="https://tiki.id/id/track"
            target="_blank">https://tiki.id/id/track</a>
        <div class="space-y-0.5 mt-3">
            <div>
                <span class="font-medium">
                    {{ __('Delivery Code') }}:
                </span>
                <span class="text-base">
                    {{ $transaction->delivery->code }}
                </span>
            </div>
            <div>
                <span class="font-medium">
                    {{ __('Description') }}:
                </span>
                <span class="text-base">
                    {{ $transaction->delivery->description ?? '-' }}
                </span>
            </div>
            <div>
                <span class="font-medium">
                    {{ __('Status') }}:
                </span>
                <span @class([
                    'text-sm',
                    'py-[.125rem]',
                    'px-2',
                    'bg-green-100' =>
                        $transaction->delivery->status ==
                        \App\Enums\DeliveryStatusType::Arrived,
                    'bg-yellow-100' =>
                        $transaction->delivery->status ==
                        \App\Enums\DeliveryStatusType::OnDelivery,
                    'text-green-700' =>
                        $transaction->delivery->status ==
                        \App\Enums\DeliveryStatusType::Arrived,
                    'text-yellow-700' =>
                        $transaction->delivery->status ==
                        \App\Enums\DeliveryStatusType::OnDelivery,
                ])>
                    {{ __(Str::headline($transaction->delivery->status)) }}
                </span>
            </div>
        </div>
    @endif
    @if ($transaction->delivery && $transaction->delivery->status != \App\Enums\DeliveryStatusType::Arrived)
        <div class="my-3 border-t"></div>
        <form wire:submit="store_delivery">
            <div class="space-y-4">
                <div>
                    <label for="code" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        {{ __('Delivery Code') }}
                    </label>
                    <input type="text" wire:model='code' id="code"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-orange-600 focus:border-orange-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-orange-500 dark:focus:border-orange-500"
                        placeholder="123456" required="">
                    @error('code')
                        <div class="mt-1 text-sm text-red-700">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div>
                    <label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        {{ __('Description') }}
                    </label>
                    <input type="text" wire:model='description' id="description"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-orange-600 focus:border-orange-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-orange-500 dark:focus:border-orange-500">
                    @error('description')
                        <div class="mt-1 text-sm text-red-700">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <button type="submit"
                    class="text-white justify-center bg-orange-700 hover:bg-orange-800 focus:ring-4 focus:outline-none focus:ring-orange-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-orange-600 dark:hover:bg-orange-700 dark:focus:ring-orange-800">
                    {{ __('Save') }}
                </button>
            </div>
        </form>
    @endif
</div>
