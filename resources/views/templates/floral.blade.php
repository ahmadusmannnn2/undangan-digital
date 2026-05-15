<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Wedding of {{ $order->groom_name }} & {{ $order->bride_name }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,400;0,600;1,400&family=Montserrat:wght@300;400;500&family=Pinyon+Script&display=swap" rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        .font-script { font-family: 'Pinyon Script', cursive; }
        .font-serif { font-family: 'Cormorant Garamond', serif; }
        .font-sans { font-family: 'Montserrat', sans-serif; }
        .floral-bg { background-color: #faf9f8; background-image: url('https://www.transparenttextures.com/patterns/floral-paper.png'); }
        .envelope-wrapper { transition: transform 1.2s cubic-bezier(0.77, 0, 0.175, 1), opacity 1.2s ease; }
        .envelope-open { transform: translateY(-100%); opacity: 0; pointer-events: none; }
        .spin { animation: spin 4s linear infinite; }
        @keyframes spin { 100% { transform: rotate(360deg); } }
        .hero-cover { background-image: url('{{ $order->cover_image ? asset("storage/" . $order->cover_image) : "https://images.unsplash.com/photo-1519225421980-715cb0215aed?q=80&w=2070&auto=format&fit=crop" }}'); background-size: cover; background-position: center; background-attachment: fixed; }
        #snow-canvas { position: fixed; top: 0; left: 0; width: 100%; height: 100%; pointer-events: none; z-index: 30; }
    </style>
</head>
<body class="floral-bg font-sans text-slate-800 overflow-hidden" id="body">

    <canvas id="snow-canvas"></canvas>

    <audio id="bg-music" loop>
        <source src="{{ $order->music_url ?? 'https://www.soundhelix.com/examples/mp3/SoundHelix-Song-1.mp3' }}" type="audio/mpeg">
    </audio>
    <button id="music-btn" class="fixed bottom-6 right-6 bg-rose-200/80 backdrop-blur text-rose-900 p-3 rounded-full shadow-lg z-40 hidden border border-rose-300 transition hover:scale-110">
        <i class="fas fa-music"></i>
    </button>

    <!-- AMPLOP DIGITAL -->
    <div id="envelope" class="envelope-wrapper fixed inset-0 z-50 flex items-center justify-center bg-white border-8 border-rose-100">
        <div class="absolute inset-0 opacity-10" style="background-image: url('https://www.transparenttextures.com/patterns/dust.png');"></div>
        <div class="text-center relative z-10 px-6 max-w-lg w-full">
            <p class="font-sans text-xs tracking-[0.3em] uppercase text-rose-400 mb-6">Pernikahan</p>
            <h1 class="font-script text-7xl md:text-8xl text-rose-800 mb-4">{{ $order->groom_name }} <br> & <br> {{ $order->bride_name }}</h1>
            <div class="mt-8 mb-8 p-4 border-t border-b border-rose-200">
                <p class="text-sm text-slate-500 mb-1">Kepada Yth. Bapak/Ibu/Saudara/i:</p>
                <p class="text-xl font-bold font-serif text-rose-900">{{ request()->query('to', 'Tamu Spesial') }}</p>
            </div>
            <button onclick="bukaUndangan()" class="bg-rose-800 hover:bg-rose-900 text-white font-serif px-10 py-4 rounded-full tracking-widest transition transform hover:scale-105 shadow-[0_10px_20px_rgba(159,18,57,0.3)] animate-bounce">
                <i class="fas fa-envelope-open mr-2"></i> BUKA UNDANGAN
            </button>
        </div>
    </div>

    <!-- KONTEN UTAMA -->
    <div id="main-content" class="opacity-0 transition-opacity duration-1000">
        
        <section class="h-screen hero-cover relative flex items-center justify-center">
            <div class="absolute inset-0 bg-slate-900/50"></div>
            <div class="relative z-10 text-center px-4" data-aos="zoom-out" data-aos-duration="2000">
                <p class="text-white tracking-[0.2em] mb-4 text-sm font-light uppercase">The Wedding Of</p>
                <h2 class="font-script text-6xl md:text-8xl text-white drop-shadow-lg mb-6">{{ $order->groom_name }} & {{ $order->bride_name }}</h2>
                <p class="text-white font-serif text-2xl italic">{{ $order->akad_datetime->translatedFormat('d F Y') }}</p>
            </div>
        </section>

        @if($order->quote)
        <section class="py-24 px-6 text-center max-w-3xl mx-auto border-b border-rose-100">
            <div data-aos="fade-up">
                <i class="fas fa-quote-left text-3xl text-rose-300 mb-6 block"></i>
                <p class="font-serif text-2xl italic text-slate-600 leading-relaxed">"{{ $order->quote }}"</p>
            </div>
        </section>
        @endif

        <!-- PROFIL MEMPELAI & INSTAGRAM -->
        <section class="py-24 px-6 bg-white relative">
            <div class="max-w-5xl mx-auto text-center">
                <h2 class="font-script text-5xl text-rose-800 mb-16" data-aos="fade-up">Mempelai</h2>
                <div class="flex flex-col md:flex-row justify-center items-center gap-16">
                    <div class="flex-1" data-aos="fade-right">
                        <div class="w-40 h-40 mx-auto rounded-full bg-rose-100 border-4 border-rose-200 mb-6 flex items-center justify-center shadow-lg">
                            <i class="fas fa-male text-6xl text-rose-800"></i>
                        </div>
                        <h3 class="font-serif text-3xl font-bold text-rose-900 mb-2">{{ $order->groom_name }}</h3>
                        <p class="text-slate-500 text-sm">Putra dari <br> <span class="font-bold text-slate-700">{{ $order->groom_parents ?? 'Bapak & Ibu' }}</span></p>
                        @if($order->groom_ig)
                        <a href="https://instagram.com/{{ str_replace('@', '', $order->groom_ig) }}" target="_blank" class="inline-block mt-3 text-rose-500 hover:text-rose-700 text-sm"><i class="fab fa-instagram mr-1"></i>{{ $order->groom_ig }}</a>
                        @endif
                    </div>
                    <div class="text-5xl font-script text-rose-300" data-aos="zoom-in">&</div>
                    <div class="flex-1" data-aos="fade-left">
                        <div class="w-40 h-40 mx-auto rounded-full bg-rose-100 border-4 border-rose-200 mb-6 flex items-center justify-center shadow-lg">
                            <i class="fas fa-female text-6xl text-rose-800"></i>
                        </div>
                        <h3 class="font-serif text-3xl font-bold text-rose-900 mb-2">{{ $order->bride_name }}</h3>
                        <p class="text-slate-500 text-sm">Putri dari <br> <span class="font-bold text-slate-700">{{ $order->bride_parents ?? 'Bapak & Ibu' }}</span></p>
                        @if($order->bride_ig)
                        <a href="https://instagram.com/{{ str_replace('@', '', $order->bride_ig) }}" target="_blank" class="inline-block mt-3 text-rose-500 hover:text-rose-700 text-sm"><i class="fab fa-instagram mr-1"></i>{{ $order->bride_ig }}</a>
                        @endif
                    </div>
                </div>
            </div>
        </section>

        <!-- KISAH CINTA (TIMELINE) -->
        @if($order->is_lovestory_active && $order->loveStories->count() > 0)
        <section class="py-24 px-6 bg-rose-50/50">
            <h2 class="font-script text-5xl text-rose-800 mb-16 text-center" data-aos="fade-up">Kisah Cinta Kami</h2>
            <div class="max-w-3xl mx-auto relative border-l border-rose-300 ml-4 md:mx-auto">
                @foreach($order->loveStories as $story)
                <div class="mb-10 ml-8 relative" data-aos="fade-left">
                    <div class="absolute -left-[41px] top-1 w-5 h-5 bg-rose-500 rounded-full border-4 border-white shadow"></div>
                    <p class="text-sm font-bold text-rose-600 mb-1"><i class="far fa-calendar-alt mr-1"></i> {{ $story->year }}</p>
                    <h3 class="font-serif text-2xl font-bold text-slate-800 mb-2">{{ $story->title }}</h3>
                    <p class="text-slate-600 text-sm leading-relaxed">{{ $story->story }}</p>
                </div>
                @endforeach
            </div>
        </section>
        @endif

        <!-- JADWAL ACARA & LIVE STREAM -->
        <section class="py-24 bg-white relative overflow-hidden">
            <div class="max-w-4xl mx-auto px-6 text-center" data-aos="fade-up">
                <h2 class="font-script text-5xl text-rose-800 mb-12">Rangkaian Acara</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-12">
                    <div class="bg-rose-50 p-8 rounded-2xl shadow-sm border border-rose-100">
                        <i class="fas fa-ring text-4xl text-rose-400 mb-4"></i>
                        <h3 class="font-serif text-2xl text-rose-900 mb-4 font-bold">Akad Nikah</h3>
                        <p class="text-lg text-slate-700 mb-2">{{ $order->akad_datetime->translatedFormat('l, d F Y') }}</p>
                        <p class="text-slate-500 font-bold mb-4">{{ $order->akad_datetime->format('H:i') }} WIB</p>
                        <p class="text-slate-600 mb-6 text-sm">{{ $order->akad_location }}</p>
                        <a href="https://maps.google.com/?q={{ urlencode($order->akad_location) }}" target="_blank" class="inline-block border border-rose-800 text-rose-800 text-xs font-bold px-4 py-2 rounded-md hover:bg-rose-800 hover:text-white transition">
                            <i class="fas fa-map-marker-alt mr-1"></i> Buka Peta
                        </a>
                    </div>
                    <div class="bg-rose-50 p-8 rounded-2xl shadow-sm border border-rose-100">
                        <i class="fas fa-glass-cheers text-4xl text-rose-400 mb-4"></i>
                        <h3 class="font-serif text-2xl text-rose-900 mb-4 font-bold">Resepsi</h3>
                        <p class="text-lg text-slate-700 mb-2">{{ $order->resepsi_datetime->translatedFormat('l, d F Y') }}</p>
                        <p class="text-slate-500 font-bold mb-4">{{ $order->resepsi_datetime->format('H:i') }} WIB</p>
                        <p class="text-slate-600 mb-6 text-sm">{{ $order->resepsi_location }}</p>
                        <a href="https://maps.google.com/?q={{ urlencode($order->resepsi_location) }}" target="_blank" class="inline-block border border-rose-800 text-rose-800 text-xs font-bold px-4 py-2 rounded-md hover:bg-rose-800 hover:text-white transition">
                            <i class="fas fa-map-marker-alt mr-1"></i> Buka Peta
                        </a>
                    </div>
                </div>

                @if($order->live_stream_url)
                <div class="bg-slate-900 rounded-xl p-6 text-white shadow-lg inline-block w-full max-w-lg mb-12">
                    <h3 class="font-bold mb-2"><i class="fas fa-video text-red-500 mr-2"></i>Live Streaming</h3>
                    <p class="text-xs text-slate-400 mb-4">Bagi yang tidak dapat hadir, Anda bisa menyaksikan secara virtual.</p>
                    <a href="{{ $order->live_stream_url }}" target="_blank" class="bg-red-600 text-white font-bold px-6 py-2 rounded-md hover:bg-red-700 transition w-full block">Tonton Sekarang</a>
                </div>
                @endif

                <!-- Timer -->
                <div class="flex justify-center gap-4 text-rose-900 font-serif">
                    <div class="bg-white p-4 rounded-lg shadow border border-rose-100 w-20"><span id="hari" class="text-3xl block font-bold">00</span><span class="text-xs">Hari</span></div>
                    <div class="bg-white p-4 rounded-lg shadow border border-rose-100 w-20"><span id="jam" class="text-3xl block font-bold">00</span><span class="text-xs">Jam</span></div>
                    <div class="bg-white p-4 rounded-lg shadow border border-rose-100 w-20"><span id="menit" class="text-3xl block font-bold">00</span><span class="text-xs">Menit</span></div>
                    <div class="bg-white p-4 rounded-lg shadow border border-rose-100 w-20"><span id="detik" class="text-3xl block font-bold">00</span><span class="text-xs">Detik</span></div>
                </div>
            </div>
        </section>

        <!-- GALERI FOTO (GRID) -->
        @if($order->is_gallery_active && $order->galleries->count() > 0)
        <section class="py-24 px-6 bg-rose-900 text-white border-t border-rose-800">
            <h2 class="font-script text-5xl text-rose-200 mb-12 text-center" data-aos="fade-up">Galeri Bahagia</h2>
            <div class="max-w-5xl mx-auto columns-2 md:columns-3 lg:columns-4 gap-4 space-y-4">
                @foreach($order->galleries as $gallery)
                <div data-aos="zoom-in" class="break-inside-avoid">
                    <img src="{{ asset('storage/' . $gallery->image_path) }}" class="w-full rounded-xl shadow-lg border-2 border-rose-800 hover:scale-105 transition duration-300" alt="Pre-wedding">
                </div>
                @endforeach
            </div>
        </section>
        @endif

        <!-- ANGPAO DIGITAL -->
        @if($order->is_angpao_active && $order->bank_account)
        <section class="py-24 px-6 text-center border-t border-rose-100 bg-white">
            <div class="max-w-lg mx-auto" data-aos="zoom-in">
                <i class="fas fa-gift text-4xl text-rose-300 mb-4 block"></i>
                <h2 class="font-script text-5xl text-rose-800 mb-4">Kado Pernikahan</h2>
                <p class="text-sm text-slate-500 mb-8">Bagi keluarga dan sahabat yang ingin memberikan tanda kasih, dapat mengirimkan melalui fitur di bawah ini:</p>
                <div class="bg-gradient-to-r from-rose-100 to-pink-50 p-8 rounded-xl shadow border border-rose-200">
                    <p class="font-bold text-lg text-slate-800 mb-1">Bank {{ $order->bank_name }}</p>
                    <p class="text-3xl font-serif tracking-widest text-rose-900 mb-2 font-bold">{{ $order->bank_account }}</p>
                    <p class="text-sm text-slate-600 mb-0">a.n. {{ $order->bank_owner }}</p>
                </div>
            </div>
        </section>
        @endif

        <!-- RSVP -->
        <section class="py-24 px-6 max-w-xl mx-auto rounded-t-full" data-aos="fade-up">
            <h2 class="font-script text-5xl text-rose-800 mb-4 text-center mt-10">Buku Tamu</h2>
            @if(session('success_rsvp'))
                <div class="bg-green-50 text-green-700 p-4 rounded-lg mb-6 text-sm text-center border border-green-200">{{ session('success_rsvp') }}</div>
            @endif
            <form action="{{ route('guest.store', $order->id) }}" method="POST" class="space-y-5 px-4">
                @csrf
                <input type="text" name="name" value="{{ request('to') }}" placeholder="Nama Anda" required class="w-full border-b border-t-0 border-x-0 border-rose-300 bg-transparent px-0 font-bold focus:ring-0">
                <select name="status" required class="w-full border-b border-t-0 border-x-0 border-rose-300 bg-transparent px-0 focus:ring-0">
                    <option value="" disabled selected>Konfirmasi Kehadiran</option>
                    <option value="hadir">Ya, Saya Akan Hadir</option>
                    <option value="tidak_hadir">Maaf, Tidak Bisa Hadir</option>
                </select>
                <textarea name="message" rows="3" placeholder="Tulis ucapan selamat..." required class="w-full border-b border-t-0 border-x-0 border-rose-300 bg-transparent px-0 focus:ring-0"></textarea>
                <button type="submit" class="w-full bg-rose-800 text-white font-serif tracking-widest py-4 rounded-md shadow-lg transition hover:bg-rose-900">KIRIM UCAPAN</button>
            </form>

            <div class="mt-12 max-h-64 overflow-y-auto space-y-4 px-4 pb-10">
                @foreach($order->guests()->latest()->get() as $guest)
                <div class="p-4 rounded-lg bg-white shadow-sm border border-rose-100">
                    <span class="font-bold text-rose-900 text-sm block mb-1">{{ $guest->name }}</span>
                    <p class="text-sm text-slate-600 font-serif italic">"{{ $guest->message }}"</p>
                    <span class="text-[10px] text-slate-400 mt-2 block">{{ $guest->created_at->diffForHumans() }}</span>
                </div>
                @endforeach
            </div>
        </section>
        
    </div>

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        const musicBtn = document.getElementById('music-btn');
        const bgMusic = document.getElementById('bg-music');
        let isPlaying = false;

        function bukaUndangan() {
            document.getElementById('envelope').classList.add('envelope-open');
            document.getElementById('body').classList.remove('overflow-hidden');
            document.getElementById('main-content').classList.remove('opacity-0');
            musicBtn.classList.remove('hidden');
            setTimeout(() => { AOS.init({ once: true }); }, 500);
            startFallingLeaves(); 
            bgMusic.play();
            isPlaying = true;
            musicBtn.classList.add('spin');
        }

        musicBtn.addEventListener('click', () => {
            if (isPlaying) { bgMusic.pause(); musicBtn.classList.remove('spin'); } 
            else { bgMusic.play(); musicBtn.classList.add('spin'); }
            isPlaying = !isPlaying;
        });

        const countDownDate = new Date("{{ $order->akad_datetime->format('M d, Y H:i:s') }}").getTime();
        const x = setInterval(function() {
            const now = new Date().getTime();
            const distance = countDownDate - now;
            if (distance < 0) {
                clearInterval(x);
                ['hari','jam','menit','detik'].forEach(id => document.getElementById(id).innerHTML = "00");
            } else {
                document.getElementById("hari").innerHTML = Math.floor(distance / (1000 * 60 * 60 * 24)).toString().padStart(2, '0');
                document.getElementById("jam").innerHTML = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60)).toString().padStart(2, '0');
                document.getElementById("menit").innerHTML = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60)).toString().padStart(2, '0');
                if(document.getElementById("detik")) document.getElementById("detik").innerHTML = Math.floor((distance % (1000 * 60)) / 1000).toString().padStart(2, '0');
            }
        }, 1000);

        function startFallingLeaves() {
            const canvas = document.getElementById("snow-canvas");
            const ctx = canvas.getContext("2d");
            let width = canvas.width = window.innerWidth;
            let height = canvas.height = window.innerHeight;
            let particles = [];
            window.addEventListener('resize', () => { width = canvas.width = window.innerWidth; height = canvas.height = window.innerHeight; });
            for (let i = 0; i < 30; i++) {
                particles.push({ x: Math.random() * width, y: Math.random() * height - height, r: Math.random() * 5 + 2, d: Math.random() * 1, color: "rgba(244, 143, 177, " + (Math.random() * 0.5 + 0.3) + ")" });
            }
            function draw() {
                ctx.clearRect(0, 0, width, height);
                for (let i = 0; i < particles.length; i++) {
                    let p = particles[i];
                    ctx.beginPath(); ctx.fillStyle = p.color; ctx.moveTo(p.x, p.y); ctx.arc(p.x, p.y, p.r, 0, Math.PI * 2, true); ctx.fill();
                }
                update();
            }
            let angle = 0;
            function update() {
                angle += 0.01;
                for (let i = 0; i < particles.length; i++) {
                    let p = particles[i];
                    p.y += Math.cos(angle + p.d) + 1 + p.r / 2; p.x += Math.sin(angle) * 2;
                    if (p.x > width + 5 || p.x < -5 || p.y > height) { particles[i] = { x: Math.random() * width, y: -10, r: p.r, d: p.d, color: p.color }; }
                }
            }
            setInterval(draw, 33);
        }
    </script>
</body>
</html>