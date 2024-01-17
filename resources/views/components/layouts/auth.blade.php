<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf_token" value="{{ csrf_token() }}" />
    <link rel="icon" type="image/png" href="{{ Vite::image('logo.png') }}" />
    <title>{{ $title ?? config('app.name') }}</title>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="{{ asset('dashboard-assets/css/nucleo-icons.css') }}" rel="stylesheet" />
    <link href="{{ asset('dashboard-assets/css/nucleo-svg.css') }}" rel="stylesheet" />
    <link href="{{ asset('dashboard-assets/css/argon-dashboard-tailwind.min.css?v=1.0.1') }}" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="m-0 font-sans text-base antialiased font-normal bg-white text-start leading-default text-slate-500">
    @yield('navbar')

    <main class="mt-0 transition-all duration-200 ease-in-out">
        <section class="min-h-screen">
            {{ $slot }}
        </section>
        @include('components.layouts.partials.auth.footer')
    </main>

    @stack('scripts')
    <x-livewire-alert::scripts />
</body>

</html>
