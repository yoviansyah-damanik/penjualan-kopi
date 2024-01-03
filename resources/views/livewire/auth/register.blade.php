<section class="min-h-screen">
    <div
        class="bg-center relative flex items-start pt-12 pb-56 m-4 overflow-hidden bg-cover min-h-50-screen rounded-xl bg-[url('../images/register-image-1.jpg')]">
        <span
            class="absolute top-0 left-0 w-full h-full bg-center bg-cover bg-gradient-to-tl from-zinc-800 to-zinc-700 opacity-60"></span>
        <div class="container z-10">
            <div class="flex flex-wrap justify-center -mx-3">
                <div class="w-full max-w-full px-3 mx-auto mt-0 text-center lg:flex-0 shrink-0 lg:w-5/12">
                    <h1 class="mt-12 mb-2 text-2xl font-bold text-white lg:text-5xl">{{ __('Welcome!') }}</h1>
                    <p class="text-white">
                        {{ __('Complete your days by drinking the coffee that we have prepared for you.') }}
                    </p>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="flex flex-wrap -mx-3 -mt-48 md:-mt-56 lg:-mt-48">
            <div class="w-full max-w-full px-3 mx-auto mt-0 md:flex-0 shrink-0 md:w-7/12 lg:w-5/12 xl:w-4/12">
                <div
                    class="relative z-0 flex flex-col min-w-0 break-words bg-white border-0 shadow-xl rounded-2xl bg-clip-border">
                    <div class="flex-auto p-6">
                        <form role="form text-left" method="post" wire:submit='register'>
                            @csrf
                            <div class="mb-4">
                                <input type="text" wire:loading.attr='disabled' wire:target='register'
                                    wire:model.defer.debounce.250ms='username' required
                                    class="focus:shadow-orange-950 text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding p-3 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-orange-950 focus:outline-none"
                                    placeholder="{{ __('Username') }}" aria-label="{{ __('Username') }}"
                                    aria-describedby="username-addon" />
                                @error('username')
                                    <div class="mt-1 ml-2 text-xs text-red-500">
                                        {{ $message }}
                                    </div>
                                @else
                                    <div class="mt-1 ml-2 text-xs text-gray">
                                        {{ __("Username must be at least 8 characters, no spaces, and no symbols (except '-' and '_').") }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <input type="text" wire:loading.attr='disabled' wire:target='register'
                                    wire:model.defer.debounce.250ms='name' required
                                    class="focus:shadow-orange-950 text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding p-3 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-orange-950 focus:outline-none"
                                    placeholder="{{ __('Full Name') }}" aria-label="{{ __('Full Name') }}"
                                    aria-describedby="full-name-addon" />
                                @error('name')
                                    <div class="mt-1 ml-2 text-xs text-red-500">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <input type="email" wire:loading.attr='disabled' wire:target='register'
                                    wire:model.defer.debounce.250ms='email' required
                                    class="focus:shadow-orange-950 text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding p-3 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-orange-950 focus:outline-none"
                                    placeholder="{{ __('Email') }}" aria-label="{{ __('Email') }}"
                                    aria-describedby="email-addon" />
                                @error('email')
                                    <div class="mt-1 ml-2 text-xs text-red-500">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <input type="password" wire:loading.attr='disabled' wire:target='register'
                                    wire:model.defer.debounce.250ms='password' required
                                    class="focus:shadow-orange-950 text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding p-3 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-orange-950 focus:outline-none"
                                    placeholder="{{ __('Password') }}" aria-label="{{ __('Password') }}"
                                    aria-describedby="password-addon" />
                                @error('password')
                                    <div class="mt-1 ml-2 text-xs text-red-500">
                                        {{ $message }}
                                    </div>
                                @else
                                    <div class="mt-1 ml-2 text-xs text-gray">
                                        {{ __('Password must be at least 8 characters.') }}
                                    </div>
                                    <div class="mt-1 ml-2 text-xs text-gray">
                                        {{ __('Password consist of a combination of letters and numbers.') }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <input type="password" wire:loading.attr='disabled' wire:target='register'
                                    wire:model.defer.debounce.250ms='re_password' required
                                    class="focus:shadow-orange-950 text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding p-3 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-orange-950 focus:outline-none"
                                    placeholder="{{ __('Re-Password') }}" aria-label="{{ __('Re-Password') }}"
                                    aria-describedby="re-password-addon" />
                                @error('re_password')
                                    <div class="mt-1 ml-2 text-xs text-red-500">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="min-h-6 pl-7 mb-0.5 block">
                                <input
                                    class="w-4.8 h-4.8 ease -ml-7 rounded-1.4 checked:bg-gradient-to-tl checked:from-orange-500 checked:to-orange-950 after:text-xxs after:font-awesome after:duration-250 after:ease-in-out duration-250 relative float-left mt-1 cursor-pointer appearance-none border border-solid border-slate-200 bg-white bg-contain bg-center bg-no-repeat align-top transition-all after:absolute after:flex after:h-full after:w-full after:items-center after:justify-center after:text-white after:opacity-0 after:transition-all after:content-['\f00c'] checked:border-0 checked:border-transparent checked:bg-transparent checked:after:opacity-100"
                                    type="checkbox" id="termsAndConditions"
                                    wire:model.defer.debounce.250ms='terms_and_conditions' wire:loading.attr='disabled'
                                    required wire:target='register' />
                                <label for="termsAndConditions"
                                    class="mb-2 ml-1 text-sm font-normal cursor-pointer text-slate-700"
                                    for="flexCheckDefault">
                                    {{ __('I agree the') }} <a href="javascript:;"
                                        class="font-bold text-slate-700">{{ __('Terms and Conditions') }}</a>
                                </label>
                            </div>
                            @error('terms_and_conditions')
                                <div class="mt-1 ml-2 text-xs text-red-500">
                                    {{ $message }}
                                </div>
                            @enderror
                            <div class="text-center">
                                <button type="submit" wire:loading.attr='disabled'
                                    wire:target='register, redirect_to_login'
                                    @if (!$submit_button) disabled @endif
                                    class="inline-block w-full px-5 py-2.5 mt-6 mb-2 font-bold text-center text-white align-middle transition-all bg-transparent border-0 rounded-lg cursor-pointer active:opacity-85 hover:-translate-y-px hover:shadow-xs leading-normal text-sm ease-in tracking-tight-rem shadow-md bg-150 bg-x-25 bg-gradient-to-br from-orange-950 to-red-700">
                                    {{ __('Sign up') }}
                                </button>
                            </div>
                            <p class="mt-4 mb-0 text-sm leading-normal text-center">
                                {{ __('Already have an account?') }}
                                <a href="{{ route('login') }}" wire:navigate
                                    class="font-semibold text-transparent bg-clip-text bg-gradient-to-br from-orange-950 to-red-700">
                                    {{ __('Sign In') }}
                                </a>
                            </p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@section('navbar')
    <nav
        class="absolute top-0 z-30 flex flex-wrap items-center justify-between w-full px-4 py-2 mt-6 mb-4 shadow-none lg:flex-nowrap lg:justify-start">
        <div class="container flex items-center justify-between py-0 flex-wrap-inherit">
            <a class="py-1.75 ml-4 mr-4 font-bold text-white text-sm whitespace-nowrap lg:ml-0" href="{{ route('home') }}">
                {{ config('app.name') }}
            </a>
            <button navbar-trigger
                class="hidden px-3 py-1 ml-2 text-lg leading-none transition-all ease-in-out bg-transparent border border-transparent border-solid rounded-lg shadow-none cursor-pointer lg:block lg:hidden"
                type="button" aria-controls="navigation" aria-expanded="false" aria-label="Toggle navigation">
                <span class="inline-block w-6 h-6 mt-2 align-middle bg-center bg-no-repeat bg-cover bg-none">
                    <span bar1
                        class="w-5.5 rounded-xs duration-350 relative my-0 mx-auto block h-px bg-white transition-all"></span>
                    <span bar2
                        class="w-5.5 rounded-xs mt-1.75 duration-350 relative my-0 mx-auto block h-px bg-white transition-all"></span>
                    <span bar3
                        class="w-5.5 rounded-xs mt-1.75 duration-350 relative my-0 mx-auto block h-px bg-white transition-all"></span>
                </span>
            </button>
            <x-auth.register-header />
        </div>
    </nav>
@endsection

@push('scripts')
    <script type="text/javascript">
        document.addEventListener('deferwire:initialized', () => {
            @this.on('successRegisterHandler', (e) => {
                console.log('waiting for redirect');
                @this.call('disable_submit_button');
                setTimeout(() => {
                    @this.call('redirect_to_login');
                }, 1500)
            })
        });
    </script>
@endpush
