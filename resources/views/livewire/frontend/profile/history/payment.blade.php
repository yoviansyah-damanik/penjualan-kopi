<div class="px-4 text-white border rounded-lg py-7 bg-orange-950">
    @if ($this->transaction->payment)
        @if ($this->transaction->payment->status == \App\Enums\PaymentStatusType::WaitingForConfirmation)
            <div>
                <span class="font-bold">{{ __('Thanks!') }}</span>
                {{ __('Your payment is currently being checked by the Administrator.') }}
            </div>
        @else
            <div>
                <span class="font-bold">Yeay!</span>
                {{ __('Your payment has been confirmed. Orders will be shipped immediately.') }}
            </div>
        @endif
    @else
        <div>
            <h5 class="mb-1 font-bold">{{ __('Select payment') }}</h5>
            <p class="mb-3 text-base text-gray-100">
                {{ __('Please select your payment method, then send according to the amount stated. We will confirm your order within 2x24 hours.') }}
                {{ __('Total Payment') }}
                <span class="font-bold text-orange-300">
                    {{ StringHelper::currency($transaction->total_payment, true) }}
                </span>.
            </p>
            <form wire:submit="store_payment" class="space-y-3">
                <ul class="grid w-full grid-cols-2 gap-2 md:gap-4 md:grid-cols-3 lg:grid-cols-4">
                    @foreach ($payment_vendors as $item)
                        <li>
                            <input type="radio" id="payment-vendor-{{ $item->id }}" wire:model="payment_vendor"
                                value="{{ $item->id }}" class="hidden peer" required>
                            <label for="payment-vendor-{{ $item->id }}"
                                class="relative inline-flex items-center justify-between w-full p-5 text-gray-500 bg-white border border-gray-200 rounded-lg cursor-pointer dark:hover:text-gray-300 dark:border-gray-700 dark:peer-checked:text-orange-500 peer-checked:border-orange-600 peer-checked:text-orange-600 hover:text-gray-600 hover:bg-gray-100 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700">
                                <div
                                    class="absolute top-0 bottom-0 left-0 right-0 z-0 flex items-center justify-center w-full overflow-hidden opacity-10">
                                    <img src="{{ $item->image_path }}" alt="{{ $item->name }} Image" class="w-full">
                                </div>
                                <div class="z-10 block">
                                    <div class="w-full text-lg font-semibold">{{ $item->name }}</div>
                                    <div class="w-full">{{ $item->account_number }}</div>
                                </div>
                                <svg class="z-10 w-5 h-5 ms-3 rtl:rotate-180" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9" />
                                </svg>
                            </label>
                        </li>
                    @endforeach
                </ul>
                @error('payment_vendor')
                    <div class="mt-1 ml-2 text-sm text-red-500">
                        {{ $message }}
                    </div>
                @enderror

                <div class="grid grid-cols-6 gap-3">
                    <div class="col-span-4 lg:col-span-5">
                        <label class="block mb-1" for="evidence">{{ __('Evidence of Payment') }}</label>
                        <input type="file" placeholder="{{ __('Evidence of Payment') }}"
                            wire:model.live.debounce.500ms='evidence' required
                            class="focus:shadow-primary-outline text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-orange-950 focus:outline-none" />
                    </div>
                    <button type="submit" wire:loading.attr='disabled' wire:target="evidence"
                        class="self-end col-span-2 lg:col-span-1 main-btn bg-gradient-to-br from-orange-950 to-red-700">
                        {{ __('Send') }}
                    </button>
                </div>
                @error('evidence')
                    <div class="mt-1 ml-2 text-sm text-red-500">
                        {{ $message }}
                    </div>
                @enderror

            </form>
        </div>
    @endif
</div>
