<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf_token" value="{{ csrf_token() }}" />
    <link rel="icon" type="image/png" href="{{ Vite::image('logo.png') }}" />
    <title>{{ $title ?? config('app.name') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="{{ asset('frontend-assets/css/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend-assets/css/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend-assets/css/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend-assets/css/LineIcons.2.0.css') }}">
    <!-- <link rel="stylesheet" href="{{ asset('frontend-assets/css/style.css"> ') }}-->
    <link rel="stylesheet" href="{{ asset('frontend-assets/css/tailwind.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/css/splide.min.css" rel="stylesheet">
    @stack('style')
</head>

<body>
    @include('components.layouts.partials.frontend.navbar', [
        'className' =>
            !empty($is_sticky) && $is_sticky
                ? 'sticky text-inherit top-0 left-0 z-40 w-full py-2 transition-all duration-300 lg:py-4 bg-[#1a120b]'
                : 'fixed top-0 left-0 z-40 w-full py-3 transition-all duration-300 lg:py-4',
    ])

    {{ $slot }}

    @include('components.layouts.partials.frontend.footer')

    <a href="#" class="back-to-top bg-gradient-to-br from-pink-950 to-red-800"><i class="lni lni-chevron-up"></i></a>

    <x-livewire-alert::scripts />
    <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/js/splide.min.js"></script>
    <script src="{{ asset('frontend-assets/js/vendor/jquery-3.5.1-min.js') }}"></script>
    <script src="{{ asset('frontend-assets/js/vendor/modernizr-3.7.1.min.js') }}"></script>
    <script src="{{ asset('frontend-assets/js/plugins.js') }}"></script>
    <script src="{{ asset('frontend-assets/js/slick.min.js') }}"></script>
    <script src="{{ asset('frontend-assets/js/jquery.easing.min.js') }}"></script>
    <script src="{{ asset('frontend-assets/js/scrolling-nav.js') }}"></script>
    <script src="{{ asset('frontend-assets/js/wow.min.js') }}"></script>
    <script src="{{ asset('frontend-assets/js/particles.min.js') }}"></script>
    <script src="{{ asset('frontend-assets/js/main.js') }}"></script>
    @stack('scripts')
</body>

</html>
