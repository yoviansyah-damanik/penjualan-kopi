<section class="min-h-screen">
    <div class="relative flex items-center min-h-screen p-0 overflow-hidden bg-center bg-cover">
        <div class="container z-1">
            <div class="flex flex-wrap -mx-3">
                <div
                    class="flex flex-col w-full max-w-full px-3 mx-auto lg:mx-0 shrink-0 md:flex-0 md:w-7/12 lg:w-5/12 xl:w-4/12">
                    <div
                        class="relative flex flex-col min-w-0 break-words bg-transparent border-0 shadow-none lg:py4 rounded-2xl bg-clip-border">
                        <div class="p-6 pb-0 mb-0">
                            <h4 class="mb-2 font-bold">{{ __('Sign In') }}</h4>
                            <p class="mb-0 leading-5">{{ __('Enter your username/email and password to sign in') }}</p>
                        </div>
                        <div class="flex-auto p-6">
                            <form role="form" wire:submit.prevent='do_login'>
                                @csrf
                                <div class="mb-4">
                                    <input type="text" placeholder="{{ __('Username') }}" wire:model.defer='username'
                                        required
                                        class="focus:shadow-orange-950 text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding p-3 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-orange-950 focus:outline-none" />
                                    @error('username')
                                        <div class="mt-1 ml-2 text-sm text-red-500">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-4">
                                    <input type="password" placeholder="{{ __('Password') }}"
                                        wire:model.defer='password' required
                                        class="focus:shadow-orange-950 text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding p-3 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-orange-950 focus:outline-none" />
                                    @error('password')
                                        <div class="mt-1 ml-2 text-sm text-red-500">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="flex items-center pl-12 mb-0.5 text-left min-h-6">
                                    <input id="remember_me" wire:model.live='remember_me'
                                        class="mt-0.5 rounded-2xl duration-250 ease-in-out after:rounded-circle after:shadow-2xl after:duration-250 checked:after:translate-x-5.3 h-5 relative float-left -ml-12 w-10 cursor-pointer appearance-none border border-solid border-gray-200 bg-zinc-700/10 bg-none bg-contain bg-left bg-no-repeat align-top transition-all after:absolute after:top-px after:h-4 after:w-4 after:translate-x-px after:bg-white after:content-[''] checked:border-orange-950/95 checked:bg-orange-950/95 checked:bg-none checked:bg-right"
                                        type="checkbox" />
                                    <label class="ml-2 text-sm font-normal cursor-pointer select-none text-slate-700"
                                        for="remember_me">{{ __('Remember Me') }}</label>
                                </div>
                                @error('remember_me')
                                    <div class="mt-1 ml-2 text-sm text-red-500">
                                        {{ $message }}
                                    </div>
                                @enderror
                                <div class="text-center">
                                    <button type="submit" wire:loading.attr='disabled' wire:target='username,password'
                                        @disabled(!$button_enabled)
                                        class="inline-block w-full px-16 py-3.5 mt-6 mb-0 font-bold leading-normal text-center text-white align-middle transition-all bg-gradient-to-br from-orange-950 to-red-700 border-0 rounded-lg cursor-pointer hover:-translate-y-px active:opacity-85 hover:shadow-xs text-sm ease-in tracking-tight-rem shadow-md bg-150 bg-x-25">
                                        {{ __('Sign In') }}
                                    </button>
                                </div>
                            </form>
                        </div>
                        <div
                            class="border-black/12.5 rounded-b-2xl border-t-0 border-solid p-6 text-center pt-0 px-1 sm:px-6">
                            <p class="mx-auto mb-6 text-sm leading-normal">
                                {{ __("Don't have an account?") }}
                                <a href="{{ route('register') }}" wire:navigate
                                    class="font-semibold text-transparent bg-clip-text bg-gradient-to-br from-orange-950 to-red-700">
                                    {{ __('Sign Up') }}</a>
                            </p>
                        </div>
                    </div>
                </div>
                <div
                    class="absolute top-0 right-0 flex-col justify-center hidden w-6/12 h-full max-w-full px-3 pr-0 my-auto text-center flex-0 lg:flex">
                    <div
                        class="relative flex flex-col justify-center h-full bg-cover px-24 m-4 overflow-hidden bg-[url('../images/login-image-1.jpg')] rounded-xl ">
                        <span
                            class="absolute top-0 left-0 w-full h-full bg-center bg-cover bg-gradient-to-br from-orange-950 to-red-700 opacity-60"></span>
                        <h4 class="z-20 mt-12 text-2xl font-bold text-white">
                            "{{ __('Good coffee will always find its audience') }}"
                        </h4>
                        <p class="z-20 text-white ">
                            {{ __('The same coffee beans can still taste different coffees in different hands. Just like affection, it will be a different story when it is in different hands') }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@section('navbar')
    <div class="container sticky top-0 z-sticky">
        <div class="flex flex-wrap -mx-3">
            <div class="w-full max-w-full px-3 flex-0">
                <nav
                    class="absolute top-0 left-0 right-0 z-30 flex flex-wrap items-center px-4 py-2 m-6 mb-0 shadow-sm rounded-xl bg-white/80 backdrop-blur-2xl backdrop-saturate-200 lg:flex-nowrap lg:justify-start">
                    <div class="flex items-center justify-between w-full p-0 mx-auto flex-wrap-inherit">
                        <a class="py-1.75 text-sm mr-4 ml-4 whitespace-nowrap font-bold text-slate-700 lg:ml-0"
                            href="{{ route('home') }}">
                            {{ config('app.name') }}
                        </a>
                        <button navbar-trigger
                            class="hidden px-3 py-1 ml-2 text-lg leading-none transition-all ease-in-out bg-transparent border border-transparent border-solid rounded-lg shadow-none cursor-pointer lg:block lg:hidden"
                            type="button" aria-controls="navigation" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="inline-block w-6 h-6 mt-2 align-middle bg-center bg-no-repeat bg-cover bg-none">
                                <span bar1
                                    class="w-5.5 rounded-xs relative my-0 mx-auto block h-px bg-gray-600 transition-all duration-300"></span>
                                <span bar2
                                    class="w-5.5 rounded-xs mt-1.75 relative my-0 mx-auto block h-px bg-gray-600 transition-all duration-300"></span>
                                <span bar3
                                    class="w-5.5 rounded-xs mt-1.75 relative my-0 mx-auto block h-px bg-gray-600 transition-all duration-300"></span>
                            </span>
                        </button>
                        <x-auth.login-header />
                    </div>
                </nav>
            </div>
        </div>
    </div>
@endsection
