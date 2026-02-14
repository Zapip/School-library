<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=DM+Sans:opsz,wght@9..40,400;500;700&display=swap" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-['DM_Sans'] text-gray-900 antialiased bg-slate-50">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-slate-50">
            <div data-animate="fade-in-up">
                <a href="/" class="flex flex-col items-center gap-2 mb-6 group">
                    <div class="p-3 bg-white rounded-2xl shadow-sm border border-gray-100 group-hover:scale-110 transition-transform duration-300">
                        <img src="{{ asset('logo.png') }}" alt="Logo" class="h-12 w-auto filter grayscale opacity-80 group-hover:grayscale-0 group-hover:opacity-100 transition-all duration-300">
                    </div>
                    <div class="text-center">
                        <h1 class="text-lg font-bold text-gray-900 tracking-tight leading-tight uppercase font-['Inter']">Perpustakaan</h1>
                        <span class="text-gray-500 font-normal text-xs block -mt-1">SMKN 2 Magelang</span>
                    </div>
                </a>
            </div>

            <div class="w-full sm:max-w-md mt-2 px-8 py-10 bg-white shadow-xl overflow-hidden sm:rounded-[2.5rem] border border-gray-100 relative" data-animate="fade-in-up">
                <!-- Decorative top border -->
                <div class="absolute top-0 left-0 w-full h-1.5 bg-gradient-to-r from-green-400 to-blue-500"></div>
                
                {{ $slot }}
            </div>
            
            <div class="mt-8 text-center text-xs text-gray-400 font-medium">
                &copy; {{ date('Y') }} SMKN 2 Magelang. <br>All rights reserved.
            </div>
        </div>
    </body>
</html>
