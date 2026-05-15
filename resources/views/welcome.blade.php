<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Platform Undangan Pernikahan Digital Premium</title>

    <!-- Memanggil CSS Laravel Vite (Tailwind) -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    
    <style>
        body { font-family: 'Inter', sans-serif; }
        .font-heading { font-family: 'Playfair Display', serif; }
    </style>
</head>
<body class="antialiased bg-slate-50 text-slate-800">

    <!-- Navbar -->
    <nav class="bg-white border-b border-slate-200 fixed w-full z-50 top-0">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <div class="flex-shrink-0 flex items-center">
                    <span class="font-heading font-bold text-2xl text-indigo-600">Undangan<span class="text-slate-800">Pro</span></span>
                </div>
                <div>
                    @if (Route::has('login'))
                        <div class="space-x-4">
                            @auth
                                <a href="{{ url('/dashboard') }}" class="text-sm font-semibold text-indigo-600 hover:text-indigo-900">Ke Dashboard</a>
                            @else
                                <a href="{{ route('login') }}" class="text-sm font-semibold text-slate-600 hover:text-slate-900">Masuk</a>
                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}" class="text-sm font-semibold bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700 transition">Daftar Gratis</a>
                                @endif
                            @endauth
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="pt-32 pb-20 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto flex flex-col-reverse md:flex-row items-center gap-12">
        <div class="flex-1 text-center md:text-left">
            <h1 class="font-heading text-4xl sm:text-5xl lg:text-6xl font-bold text-slate-900 leading-tight mb-6">
                Sebarkan Momen Bahagia Anda dengan <span class="text-indigo-600">Elegan & Modern</span>
            </h1>
            <p class="text-lg text-slate-600 mb-8 max-w-2xl mx-auto md:mx-0">
                Buat undangan pernikahan digital berkelas dalam hitungan menit. Dilengkapi dengan animasi cantik, pemutar musik, dan buku tamu otomatis.
            </p>
            <div class="space-x-4">
                <a href="#katalog" class="inline-block bg-indigo-600 text-white font-semibold px-8 py-3 rounded-lg shadow-lg hover:bg-indigo-700 hover:-translate-y-1 transition-all">Lihat Tema</a>
                <a href="{{ route('register') }}" class="inline-block bg-white text-indigo-600 font-semibold px-8 py-3 rounded-lg border border-indigo-200 shadow-sm hover:bg-indigo-50 transition-all">Buat Sekarang</a>
            </div>
        </div>
        <div class="flex-1 relative">
            <div class="absolute inset-0 bg-indigo-200 rounded-full blur-3xl opacity-50"></div>
            <img src="https://images.unsplash.com/photo-1511285560929-80b456fea0bc?q=80&w=2069&auto=format&fit=crop" alt="Wedding" class="relative rounded-2xl shadow-2xl border-4 border-white transform rotate-2 hover:rotate-0 transition duration-500">
        </div>
    </section>

    <!-- Keunggulan (Features) -->
    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="font-heading text-3xl font-bold text-slate-900 mb-4">Mengapa Memilih Kami?</h2>
                <p class="text-slate-600">Fitur lengkap untuk menyempurnakan hari istimewa Anda.</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 text-center">
                <div class="p-6">
                    <div class="w-16 h-16 bg-indigo-100 text-indigo-600 rounded-full flex items-center justify-center mx-auto mb-4 text-2xl">✨</div>
                    <h3 class="text-xl font-semibold mb-2">Desain Eksklusif</h3>
                    <p class="text-slate-600">Template premium dengan tipografi indah dan animasi mulus (AOS) yang memukau tamu Anda.</p>
                </div>
                <div class="p-6">
                    <div class="w-16 h-16 bg-indigo-100 text-indigo-600 rounded-full flex items-center justify-center mx-auto mb-4 text-2xl">🎵</div>
                    <h3 class="text-xl font-semibold mb-2">Musik Latar Pilihan</h3>
                    <p class="text-slate-600">Gunakan lagu kenangan Anda dan pasangan agar undangan terasa lebih personal dan romantis.</p>
                </div>
                <div class="p-6">
                    <div class="w-16 h-16 bg-indigo-100 text-indigo-600 rounded-full flex items-center justify-center mx-auto mb-4 text-2xl">📖</div>
                    <h3 class="text-xl font-semibold mb-2">Buku Tamu Canggih</h3>
                    <p class="text-slate-600">Terima ucapan doa dan kelola konfirmasi kehadiran (RSVP) langsung dari dashboard Anda.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Katalog Template -->
    <section id="katalog" class="py-20 bg-slate-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="font-heading text-3xl font-bold text-slate-900 mb-4">Pilih Tema Undangan Anda</h2>
                <p class="text-slate-600">Beragam pilihan tema yang bisa disesuaikan dengan konsep pernikahan Anda.</p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($templates as $template)
                <div class="bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-xl transition-shadow border border-slate-100 group">
                    <div class="relative h-64 overflow-hidden bg-slate-200">
                        @if($template->preview_image)
                            <img src="{{ asset('storage/' . $template->preview_image) }}" alt="{{ $template->name }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                        @else
                            <div class="w-full h-full flex items-center justify-center text-slate-400">Tidak ada gambar</div>
                        @endif
                        <div class="absolute top-4 right-4 bg-white/90 backdrop-blur px-3 py-1 rounded-full text-sm font-bold text-indigo-600 shadow">
                            Rp {{ number_format($template->price, 0, ',', '.') }}
                        </div>
                    </div>
                    <div class="p-6">
                        <h3 class="font-heading text-xl font-bold mb-2">{{ $template->name }}</h3>
                        <p class="text-slate-500 text-sm mb-4 line-clamp-2">{{ $template->description ?? 'Tema undangan pernikahan modern dengan fitur lengkap.' }}</p>
                        <a href="{{ route('register') }}" class="block w-full text-center bg-slate-900 text-white font-semibold py-2.5 rounded-lg hover:bg-indigo-600 transition-colors">Gunakan Tema Ini</a>
                    </div>
                </div>
                @empty
                <div class="col-span-full text-center text-slate-500 py-10">
                    Belum ada template yang tersedia.
                </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-slate-900 text-slate-400 py-12 text-center">
        <div class="max-w-7xl mx-auto px-4">
            <span class="font-heading font-bold text-2xl text-white mb-4 block">UndanganPro</span>
            <p class="mb-6 max-w-md mx-auto">Membantu jutaan pasangan menyebarkan kebahagiaan mereka dengan cara yang lebih modern, cepat, dan ramah lingkungan.</p>
            <p>&copy; {{ date('Y') }} UndanganPro. All rights reserved.</p>
        </div>
    </footer>

</body>
</html>