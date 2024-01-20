<div class="{{ $className }}" id="navbar-area">
    <div class="container relative">
        <div class="row">
            <div class="w-full">
                <nav class="flex items-center justify-between navbar navbar-expand-lg">
                    <a class="mr-4 navbar-brand" href="{{ route('home') }}" wire:navigate>
                        <img class="w-[65px]" src="{{ Vite::image('logo.png') }}" alt="Logo">
                    </a>
                    <button class="block navbar-toggler focus:outline-none lg:hidden" type="button"
                        data-toggle="collapse" data-target="#navbarOne" aria-controls="navbarOne" aria-expanded="false"
                        aria-label="Toggle navigation">
                        <span class="toggler-icon"></span>
                        <span class="toggler-icon"></span>
                        <span class="toggler-icon"></span>
                    </button>

                    <div class="absolute left-0 z-50 hidden w-full px-5 py-1 duration-300 bg-white shadow lg:w-auto navbar-collapse lg:block top-[120%] mt-full lg:static lg:bg-transparent lg:shadow-none"
                        id="navbarOne">
                        <ul id="nav" class="items-center content-start mr-auto lg:justify-end navbar-nav lg:flex">
                            <li class="nav-item">
                                <a wire:navigate href="{{ route('home') }}">{{ __('Home') }}</a>
                            </li>
                            <li class="nav-item">
                                <a wire:navigate href="{{ route('product') }}">{{ __('Products') }}</a>
                            </li>
                            <li class="nav-item">
                                <a wire:navigate href="{{ route('about') }}">{{ __('About Us') }}</a>
                            </li>
                            @auth
                                @if (Auth::user()->is_administrator)
                                    <li class="block nav-item lg:hidden">
                                        <a wire:navigate href="{{ route('dashboard.home') }}">
                                            {{ __('Dashboard') }}
                                        </a>
                                    </li>
                                @endif
                                <li class="block nav-item lg:hidden">
                                    <livewire:auth.logout class_name="px-4 py-3 w-full focus:outline-none text-start"
                                        :title="__('Sign Out')" />
                                </li>
                            @else
                                <li class="block nav-item lg:hidden">
                                    <a wire:navigate href="{{ route('login') }}">
                                        {{ __('Sign In') }}
                                    </a>
                                </li>
                            @endauth
                        </ul>
                    </div>

                    <div class="absolute right-0 me-16 lg:me-24 navbar-btn lg:mt-0 lg:static lg:mr-0">
                        @guest
                            <a class="!hidden lg:!inline-block main-btn bg-gradient-to-br from-orange-950 to-red-700"
                                data-scroll-nav="0" href="{{ route('login') }}" rel="nofollow">
                                {{ __('Sign In') }}
                            </a>
                        @else
                            <div class="flex items-center gap-6 text-white" id="profile">
                                <livewire:frontend.cart.index />
                                <div class="h-9 w-[1px] bg-white"></div>
                                <div class="inline-block lg:hidden">
                                    <a href="{{ route('profile') }}" wire:navigate>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36"
                                            viewBox="0 0 24 24">
                                            <path fill="currentColor"
                                                d="M12 11q.825 0 1.413-.588Q14 9.825 14 9t-.587-1.413Q12.825 7 12 7q-.825 0-1.412.587Q10 8.175 10 9q0 .825.588 1.412Q11.175 11 12 11Zm0 2q-1.65 0-2.825-1.175Q8 10.65 8 9q0-1.65 1.175-2.825Q10.35 5 12 5q1.65 0 2.825 1.175Q16 7.35 16 9q0 1.65-1.175 2.825Q13.65 13 12 13Zm0 11q-2.475 0-4.662-.938q-2.188-.937-3.825-2.574Q1.875 18.85.938 16.663Q0 14.475 0 12t.938-4.663q.937-2.187 2.575-3.825Q5.15 1.875 7.338.938Q9.525 0 12 0t4.663.938q2.187.937 3.825 2.574q1.637 1.638 2.574 3.825Q24 9.525 24 12t-.938 4.663q-.937 2.187-2.574 3.825q-1.638 1.637-3.825 2.574Q14.475 24 12 24Zm0-2q1.8 0 3.375-.575T18.25 19.8q-.825-.925-2.425-1.612q-1.6-.688-3.825-.688t-3.825.688q-1.6.687-2.425 1.612q1.3 1.05 2.875 1.625T12 22Zm-7.7-3.6q1.2-1.3 3.225-2.1q2.025-.8 4.475-.8q2.45 0 4.463.8q2.012.8 3.212 2.1q1.1-1.325 1.713-2.95Q22 13.825 22 12q0-2.075-.788-3.887q-.787-1.813-2.15-3.175q-1.362-1.363-3.175-2.151Q14.075 2 12 2q-2.05 0-3.875.787q-1.825.788-3.187 2.151Q3.575 6.3 2.788 8.113Q2 9.925 2 12q0 1.825.6 3.463q.6 1.637 1.7 2.937Z" />
                                        </svg>
                                    </a>
                                </div>
                                <div class="relative hidden lg:flex lg:items-center lg:justify-center lg:gap-4 lg:bg-transparent lg:p-2 before:rounded-xl before:absolute before:inset-0 before:hover:bg-red-900/40 before:transition-all before:duration-150 before:-z-10"
                                    data-scroll-nav="0" href="#" rel="nofollow">
                                    <img class="rounded-full w-9 h-9" src="{{ Auth::user()->image_path }}"
                                        alt="user photo">
                                    <div class="hidden lg:flex lg:flex-col">
                                        <a href="{{ route('profile') }}" wire:navigate
                                            class="block overflow-hidden font-semibold text-ellipsis whitespace-nowrap w-[180px] hover:underline">
                                            {{ Auth::user()->name }}
                                        </a>
                                        <div class="flex items-center justify-between mt-1 text-sm">
                                            @if (Auth::user()->is_administrator)
                                                <a href="{{ route('dashboard.home') }}" class="hover:underline">
                                                    {{ __('Dashboard') }}
                                                </a>
                                            @endif
                                            <livewire:auth.logout />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endguest
                </nav>
            </div>
        </div>
    </div>
</div>
