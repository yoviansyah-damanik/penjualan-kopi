<footer class="py-12">
    <div class="container">
        <div class="flex flex-wrap -mx-3">
            <div class="flex-shrink-0 w-full max-w-full mx-auto mb-6 text-center lg:flex-0 lg:w-8/12">
                <a href="{{ route('home') }}" target="_blank" class="mb-2 mr-4 text-slate-400 sm:mb-0 xl:mr-12">
                    {{ __('Home') }}
                </a>
                <a href="{{ route('product') }}" target="_blank" class="mb-2 mr-4 text-slate-400 sm:mb-0 xl:mr-12">
                    {{ __('Products') }} </a>
                <a href="{{ route('about') }}" target="_blank" class="mb-2 mr-4 text-slate-400 sm:mb-0 xl:mr-12">
                    {{ __('About Us') }} </a>
            </div>
            <div class="flex-shrink-0 w-full max-w-full mx-auto mt-2 mb-6 text-center lg:flex-0 lg:w-8/12">
                <a href="javascript:;" target="_blank" class="mr-6 text-slate-400">
                    <span class="text-lg fab fa-facebook"></span>
                </a>
                <a href="javascript:;" target="_blank" class="mr-6 text-slate-400">
                    <span class="text-lg fab fa-twitter"></span>
                </a>
                <a href="javascript:;" target="_blank" class="mr-6 text-slate-400">
                    <span class="text-lg fab fa-instagram"></span>
                </a>
            </div>
        </div>
        <div class="flex flex-wrap -mx-3">
            <div class="w-8/12 max-w-full px-3 mx-auto mt-1 text-center flex-0">
                <p class="mb-0 text-sm text-slate-400">
                    Copyright © {{ date('Y') }}
                    {{ config('app.name') }}.
                </p>
            </div>
        </div>
    </div>
</footer>
