<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <!-- CSS Lama -->
        <link rel="stylesheet" href="{{ asset('css/adaptation.css') }}">
        <link rel="stylesheet" href="{{ asset('css/car.css') }}">
        <link rel="stylesheet" href="{{ asset('css/checkout.css') }}">
        <link rel="stylesheet" href="{{ asset('css/footer.css') }}">
        <link rel="stylesheet" href="{{ asset('css/header.css') }}">
        <link rel="stylesheet" href="{{ asset('css/main.css') }}">
        <link rel="stylesheet" href="{{ asset('css/pages.css') }}">

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">

            {{-- Header lama (blocks/header.blade.php) --}}
            @include('blocks.header')

            {{-- Navigation Breeze --}}
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main>
                @yield('main') 
                @yield('car_info')
                @yield('checkout')
                @yield('rentRules')
                @yield('aboutUs')
                
                {{-- biasanya section isinya @section('content') bukan 'main' --}}
            </main>

            {{-- Footer lama (blocks/footer.blade.php) --}}
            @include('blocks.footer')

        </div>
    </body>
</html>
