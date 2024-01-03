<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" type="image/png" href="{{ Vite::image('logo.png') }}" />
    <title>{{ $title ?? config('app.name') }} | {{ __('Dashboard') }}</title>
    <link rel="stylesheet" href="{{ asset('dashboard-assets/css/style.css') }}" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('style')
</head>

<body class="bg-gray-50 dark:bg-gray-800">
    @include('components.layouts.partials.backend.header')
    <div class="flex pt-16 overflow-hidden bg-gray-50 dark:bg-gray-900">
        <x-backend.sidebar />
        <div id="main-content" class="relative w-full h-full overflow-y-auto bg-gray-50 lg:ml-64 dark:bg-gray-900">
            <main>
                <div class="p-4">
                    <x-backend.breadcrumb />
                    <h1 class="text-xl font-semibold text-gray-900 sm:text-2xl dark:text-white">
                        {{ $title ?? __('Set your title') }}
                    </h1>
                </div>

                {{ $slot }}
            </main>
            @include('components.layouts.partials.backend.footer')
        </div>
    </div>

    <x-livewire-alert::scripts />
    <script src="{{ asset('dashboard-assets/js/index.js') }}" type="module"></script>
    @stack('scripts')
</body>

</html>
