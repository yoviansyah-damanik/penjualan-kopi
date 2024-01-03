<div class="min-h-[60vh]">
    <div class="container py-12">
        <ul class="flex gap-2">
            <li>
                <a class="px-4 py-2 transition duration-100 rounded-md bg-orange-900/10 hover:bg-orange-900 hover:text-white @if (request()->routeIs('profile')) pointer-events-none cursor-not-allowed bg-orange-950 text-white @endif"
                    href="{{ route('profile') }}" wire:navigate>
                    {{ __('Account') }}
                </a>
            </li>
            <li>
                <a class="px-4 py-2 transition duration-100 rounded-md bg-orange-900/10 hover:bg-orange-900 hover:text-white @if (request()->routeIs('profile.history*')) pointer-events-none cursor-not-allowed bg-orange-950 text-white @endif"
                    href="{{ route('profile.history') }}" wire:navigate>
                    {{ __('History') }}
                </a>
            </li>
        </ul>

        <div class="flex flex-col gap-5 lg:flex-row mt-7">
            <div class="flex-none w-full lg:w-1/2">
                <div class="border shadow-md p-7 bg-orange-900/5 rounded-xl wow fadeIn">
                    <livewire:frontend.profile.account.information />
                </div>
            </div>
            <div class="flex-none w-full lg:w-1/2">
                <div class="border shadow-md p-7 bg-orange-900/5 rounded-xl wow fadeIn">
                    <livewire:frontend.profile.account.password />
                </div>
            </div>
        </div>
    </div>
</div>
