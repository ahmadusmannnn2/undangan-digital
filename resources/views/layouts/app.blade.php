<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'UndanganPro') }} - Premium Dashboard</title>

        <!-- Fonts & Icons -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
        <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #f8fafc; }
            /* Animasi Latar Belakang (Mesh Gradient Blobs) */
            .blob { position: absolute; filter: blur(80px); z-index: -1; opacity: 0.6; animation: float 10s infinite ease-in-out alternate; }
            .blob-1 { top: -10%; left: -10%; width: 500px; height: 500px; background: #c7d2fe; animation-delay: 0s; }
            .blob-2 { bottom: -20%; right: -10%; width: 600px; height: 600px; background: #e0e7ff; animation-delay: 2s; }
            .blob-3 { top: 40%; left: 40%; width: 400px; height: 400px; background: #fbcfe8; animation-delay: 4s; }
            
            @keyframes float { 
                0% { transform: translate(0, 0) scale(1); } 
                100% { transform: translate(30px, 50px) scale(1.1); } 
            }
            
            /* Glassmorphism Utilities */
            .glass { background: rgba(255, 255, 255, 0.7); backdrop-filter: blur(16px); -webkit-backdrop-filter: blur(16px); border: 1px solid rgba(255, 255, 255, 0.5); }
            .glass-card { background: rgba(255, 255, 255, 0.4); backdrop-filter: blur(20px); -webkit-backdrop-filter: blur(20px); border: 1px solid rgba(255, 255, 255, 0.6); box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.05); }
        </style>
    </head>
    <body class="font-sans antialiased text-slate-800 relative min-h-screen overflow-x-hidden">
        
        <!-- Animated Background Elements -->
        <div class="fixed inset-0 z-[-1] overflow-hidden pointer-events-none">
            <div class="blob blob-1 rounded-full"></div>
            <div class="blob blob-2 rounded-full"></div>
            <div class="blob blob-3 rounded-full"></div>
        </div>

        <div class="min-h-screen relative z-10">
            @include('layouts.navigation')

            <!-- Header Animasi -->
            @isset($header)
                <header class="glass sticky top-16 z-30 transition-all duration-300">
                    <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8" data-aos="fade-down" data-aos-duration="800">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>

        <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
        <script>
            AOS.init({ once: true, offset: 50 });
        </script>
    </body>
</html>