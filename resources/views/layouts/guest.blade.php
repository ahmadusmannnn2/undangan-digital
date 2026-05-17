<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'UndanganPro') }} - Autentikasi</title>

        <!-- Fonts & Icons -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #f8fafc; }
            /* Animasi Latar Belakang */
            .blob { position: absolute; filter: blur(80px); z-index: -1; opacity: 0.6; animation: float 10s infinite ease-in-out alternate; }
            .blob-1 { top: -10%; left: -10%; width: 500px; height: 500px; background: #c7d2fe; animation-delay: 0s; }
            .blob-2 { bottom: -20%; right: -10%; width: 600px; height: 600px; background: #e0e7ff; animation-delay: 2s; }
            .blob-3 { top: 40%; left: 40%; width: 400px; height: 400px; background: #fbcfe8; animation-delay: 4s; }
            
            @keyframes float { 
                0% { transform: translate(0, 0) scale(1); } 
                100% { transform: translate(30px, 50px) scale(1.1); } 
            }
            
            /* Glassmorphism */
            .glass-card { background: rgba(255, 255, 255, 0.4); backdrop-filter: blur(20px); -webkit-backdrop-filter: blur(20px); border: 1px solid rgba(255, 255, 255, 0.6); box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.05); }
        </style>
    </head>
    <body class="font-sans text-slate-800 antialiased relative min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 overflow-hidden">
        
        <!-- Animated Background Elements -->
        <div class="fixed inset-0 z-[-1] overflow-hidden pointer-events-none">
            <div class="blob blob-1 rounded-full"></div>
            <div class="blob blob-2 rounded-full"></div>
            <div class="blob blob-3 rounded-full"></div>
        </div>

        <div class="relative z-10 w-full flex flex-col items-center">
            <div>
                <a href="/" class="text-3xl font-extrabold text-indigo-600 tracking-tight flex items-center gap-2 mb-6 hover:scale-105 transition-transform">
                    <div class="w-10 h-10 bg-gradient-to-tr from-indigo-600 to-purple-600 rounded-xl flex items-center justify-center text-white shadow-lg shadow-indigo-500/30">
                        <i class="fas fa-gem text-lg"></i>
                    </div>
                    Undangan<span class="text-slate-800">Pro</span>
                </a>
            </div>

            <div class="w-full sm:max-w-md mt-2 px-8 py-10 glass-card sm:rounded-3xl overflow-hidden relative">
                <!-- Dekorasi Sudut -->
                <div class="absolute -top-10 -right-10 w-32 h-32 bg-white/40 rounded-full blur-xl"></div>
                <div class="relative z-10">
                    {{ $slot }}
                </div>
            </div>
            
            <p class="mt-8 text-sm text-slate-500 font-medium tracking-wide">
                &copy; {{ date('Y') }} UndanganPro. All rights reserved.
            </p>
        </div>
    </body>
</html>