<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Undangan Pernikahan: {{ $order->groom_name }} & {{ $order->bride_name }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Great+Vibes&family=Lora:ital,wght@0,400;0,700;1,400&display=swap" rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        .font-handwriting { font-family: 'Great Vibes', cursive; }
        .font-body { font-family: 'Lora', serif; }
        .bg-rustic { background-color: #fcf9f2; }
        .envelope-wrapper { transition: transform 1.2s cubic-bezier(0.77, 0, 0.175, 1), opacity 1.2s ease; }
        .envelope-open { transform: translateY(-100%); opacity: 0; pointer-events: none; }
        .spin { animation: spin 4s linear infinite; }
        @keyframes spin { 100% { transform: rotate(360deg); } }
        .cover-bg { background-image: linear-gradient(rgba(252, 249, 242, 0.85), rgba(252, 249, 242, 0.95)), url('{{ $order->cover_image ? asset("storage/" . $order->cover_image) : "https://www.transparenttextures.com/patterns/wood-pattern.png" }}'); background-size: cover; background-position: center; background-attachment: fixed; }
    </style>
</head>
<body class="bg-rustic font-body text-gray-800 overflow-hidden" id="body">

    <audio id="bg-music" loop>
        <source src="{{ $order->music_url ?? 'https://www.soundhelix.com/examples/mp3/SoundHelix-Song-1.mp3' }}" type="audio/mpeg">
    </audio>
    <button id="music-btn" class="fixed bottom-6 right-6 bg-amber-800 text-white p-4 rounded-full shadow-2xl z-40 hidden border border-amber-200 transition-transform hover:scale-110">
        <i class="fas fa-music"></i>
    </button>

    <!-- AMPLOP DIGITAL -->
    <div id="envelope" class="envelope-wrapper fixed inset-0 z-50 flex items-center justify-center bg-amber-50 border-[16px] border-amber-900/10" style="background-image: url('https://www.transparenttextures.com/patterns/rice-paper-2.png');">
        <div class="text-center relative z-10 px-6 max-w-lg w-full">
            <div class="w-16 h-16 mx-auto mb-4 bg-amber-800 text-white rounded-full flex items-center justify-center text-2xl font-handwriting">
                {{ substr($order->groom_name, 0, 1) }}&{{ substr($order->bride_name, 0, 1) }}
            </div>
            <p class="text-sm tracking-widest uppercase mb-2 text-amber-700 font-bold">The Wedding Of</p>
            <h1 class="text-6xl md:text-8xl font-handwriting text-amber-900 mb-4">{{ $order->groom_name }} & {{ $order->bride_name }}</h1>
            
            <div class="my-8 bg-white/60 p-6 rounded-lg border border-amber-200 shadow-sm">
                <p class="text-sm text-gray-500 mb-2">Kepada Yth. Bapak/Ibu/Saudara/i:</p>
                <p class="text-2xl font-bold text-amber-900">{{ request()->query('to', 'Tamu Spesial') }}</p>
            </div>
            
            <button onclick="bukaUndangan()" class="bg-amber-800 hover:bg-amber-900 text-white font-bold px-10 py-4 rounded-md tracking-widest transition transform hover:-translate-y-1 shadow-xl">
                BUKA UNDANGAN
            </button>
        </div>
    </div>

    <!-- KONTEN UTAMA -->
    <div id="main-content" class="opacity-0 transition-opacity duration-1000">
        
        <section class="min-h-screen flex flex-col items-center justify-center text-center p-6 relative cover-bg">
            <div data-aos="zoom-in" data-aos-duration="2000" class="bg-white/60 p-12 rounded-full backdrop-blur-sm border border-amber-800/30 shadow-2xl">
                <p class="text-sm tracking-widest uppercase mb-4 text-amber-900 font-bold">Pernikahan</p>
                <h2 class="text-6xl md:text-8xl font-handwriting text-amber-900 mb-6 drop-shadow-md">{{ $order->groom_name }} <br> <span class="text-4xl">&</span> <br> {{ $order->bride_name }}</h2>
                <p class="text-xl italic text-amber-950 font-bold">{{ $order->akad_datetime->translatedFormat('d F Y') }}</p>
            </div>
        </section>

        @if($order->quote)
        <section class="py-20 px-6 text-center max-w-3xl mx-auto border-b border-amber-200">
            <div data-aos="fade-up">
                <i class="fas fa-leaf text-3xl text-amber-700 mb-6 block"></i>
                <p class="text-xl italic text-gray-700 leading-relaxed">"{{ $order->quote }}"</p>
            </div>
        </section>
        @endif

        <section class="py-20 px-6 text-center">
            <div class="max-w-4xl mx-auto">
                <h2 class="text-4xl font-handwriting text-amber-900 mb-12" data-aos="fade-up">Pasangan Mempelai</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
                    <div data-aos="fade-right">
                        <div class="w-32 h-32 mx-auto rounded-full bg-amber-100 border border-amber-300 mb-4 flex items-center justify-center">
                            <i class="fas fa-user-tie text-4xl text-amber-800"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-amber-900 mb-2">{{ $order->groom_name }}</h3>
                        <p class="text-gray-600 text-sm">Putra dari <br> <strong>{{ $order->groom_parents ?? 'Keluarga Pria' }}</strong></p>
                        @if($order->groom_ig)
                        <a href="https://instagram.com/{{ str_replace('@', '', $order->groom_ig) }}" target="_blank" class="text-amber-600 text-sm mt-2 block hover:text-amber-800"><i class="fab fa-instagram mr-1"></i>{{ $order->groom_ig }}</a>
                        @endif
                    </div>
                    <div data-aos="fade-left">
                        <div class="w-32 h-32 mx-auto rounded-full bg-amber-100 border border-amber-300 mb-4 flex items-center justify-center">
                            <i class="fas fa-user text-4xl text-amber-800"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-amber-900 mb-2">{{ $order->bride_name }}</h3>
                        <p class="text-gray-600 text-sm">Putri dari <br> <strong>{{ $order->bride_parents ?? 'Keluarga Wanita' }}</strong></p>
                        @if($order->bride_ig)
                        <a href="https://instagram.com/{{ str_replace('@', '', $order->bride_ig) }}" target="_blank" class="text-amber-600 text-sm mt-2 block hover:text-amber-800"><i class="fab fa-instagram mr-1"></i>{{ $order->bride_ig }}</a>
                        @endif
                    </div>
                </div>
            </div>
        </section>

        <!-- KISAH CINTA -->
        @if($order->is_lovestory_active && $order->loveStories->count() > 0)
        <section class="py-20 px-6 bg-white border-t border-amber-100">
            <h2 class="text-4xl font-handwriting text-amber-900 mb-12 text-center" data-aos="fade-up">Kisah Cinta Kami</h2>
            <div class="max-w-2xl mx-auto space-y-8">
                @foreach($order->loveStories as $story)
                <div class="bg-amber-50 p-6 rounded-lg border border-amber-200" data-aos="fade-up">
                    <span class="bg-amber-800 text-white text-xs font-bold px-3 py-1 rounded-full mb-3 inline-block">{{ $story->year }}</span>
                    <h3 class="font-bold text-amber-900 text-xl mb-2">{{ $story->title }}</h3>
                    <p class="text-gray-700 text-sm">{{ $story->story }}</p>
                </div>
                @endforeach
            </div>
        </section>
        @endif

        <section class="py-20 px-6 bg-amber-900 text-white border-y border-amber-100 relative">
            <div class="max-w-4xl mx-auto text-center" data-aos="fade-up">
                <h2 class="text-4xl font-handwriting text-amber-200 mb-12">Informasi Acara</h2>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-10">
                    <div class="bg-white/10 p-8 rounded-xl border border-amber-700">
                        <h3 class="text-2xl font-bold text-amber-300 mb-2">Akad Nikah</h3>
                        <p class="text-lg font-semibold">{{ $order->akad_datetime->translatedFormat('l, d F Y') }}</p>
                        <p class="mb-4">{{ $order->akad_datetime->format('H:i') }} WIB</p>
                        <p class="text-sm text-gray-300 mb-6">{{ $order->akad_location }}</p>
                        <a href="https://maps.google.com/?q={{ urlencode($order->akad_location) }}" target="_blank" class="bg-amber-200 text-amber-900 px-6 py-2 rounded text-sm font-bold hover:bg-white"><i class="fas fa-map-marker-alt mr-2"></i> Peta Akad</a>
                    </div>
                    <div class="bg-white/10 p-8 rounded-xl border border-amber-700">
                        <h3 class="text-2xl font-bold text-amber-300 mb-2">Resepsi</h3>
                        <p class="text-lg font-semibold">{{ $order->resepsi_datetime->translatedFormat('l, d F Y') }}</p>
                        <p class="mb-4">{{ $order->resepsi_datetime->format('H:i') }} WIB</p>
                        <p class="text-sm text-gray-300 mb-6">{{ $order->resepsi_location }}</p>
                        <a href="https://maps.google.com/?q={{ urlencode($order->resepsi_location) }}" target="_blank" class="bg-amber-200 text-amber-900 px-6 py-2 rounded text-sm font-bold hover:bg-white"><i class="fas fa-map-marker-alt mr-2"></i> Peta Resepsi</a>
                    </div>
                </div>

                @if($order->live_stream_url)
                <a href="{{ $order->live_stream_url }}" target="_blank" class="inline-block bg-red-600 text-white font-bold px-8 py-3 rounded-full hover:bg-red-700 shadow-lg mb-10">
                    <i class="fas fa-video mr-2"></i> Tonton Live Streaming
                </a>
                @endif

                <div class="flex justify-center gap-4">
                    <div class="bg-black/30 p-4 rounded-lg w-20"><span id="hari" class="text-2xl font-bold text-amber-200 block">00</span><span class="text-xs text-gray-400">Hari</span></div>
                    <div class="bg-black/30 p-4 rounded-lg w-20"><span id="jam" class="text-2xl font-bold text-amber-200 block">00</span><span class="text-xs text-gray-400">Jam</span></div>
                    <div class="bg-black/30 p-4 rounded-lg w-20"><span id="menit" class="text-2xl font-bold text-amber-200 block">00</span><span class="text-xs text-gray-400">Menit</span></div>
                    <div class="bg-black/30 p-4 rounded-lg w-20"><span id="detik" class="text-2xl font-bold text-amber-200 block">00</span><span class="text-xs text-gray-400">Detik</span></div>
                </div>
            </div>
        </section>

        <!-- GALERI -->
        @if($order->is_gallery_active && $order->galleries->count() > 0)
        <section class="py-20 px-6 bg-white border-b border-amber-200">
            <h2 class="text-4xl font-handwriting text-amber-900 mb-10 text-center" data-aos="fade-up">Galeri</h2>
            <div class="max-w-5xl mx-auto columns-2 md:columns-3 gap-4 space-y-4">
                @foreach($order->galleries as $gallery)
                <div data-aos="zoom-in">
                    <img src="{{ asset('storage/' . $gallery->image_path) }}" class="w-full rounded-md shadow-sm border border-gray-200" alt="Gallery">
                </div>
                @endforeach
            </div>
        </section>
        @endif

        @if($order->is_angpao_active && $order->bank_account)
        <section class="py-20 px-6 text-center">
            <div class="max-w-md mx-auto" data-aos="zoom-in">
                <i class="fas fa-envelope-open-text text-4xl text-amber-800 mb-4 block"></i>
                <h2 class="text-4xl font-handwriting text-amber-900 mb-4">Tanda Kasih</h2>
                <div class="bg-white p-6 rounded-lg border-2 border-dashed border-amber-300 shadow-sm">
                    <p class="font-bold text-amber-900 mb-1">{{ $order->bank_name }}</p>
                    <p class="text-2xl tracking-widest text-gray-800 mb-2 font-bold">{{ $order->bank_account }}</p>
                    <p class="text-sm text-gray-500 mb-0">a.n. {{ $order->bank_owner }}</p>
                </div>
            </div>
        </section>
        @endif

        <section class="py-20 px-6 bg-amber-900 text-white" data-aos="fade-up">
            <div class="max-w-xl mx-auto bg-white text-gray-800 p-8 rounded-xl shadow-2xl">
                <h2 class="text-4xl font-handwriting text-amber-900 mb-2 text-center">Buku Tamu</h2>
                @if(session('success_rsvp'))
                    <div class="bg-green-100 text-green-700 p-3 rounded mb-4 text-sm text-center font-bold">{{ session('success_rsvp') }}</div>
                @endif
                <form action="{{ route('guest.store', $order->id) }}" method="POST" class="space-y-4">
                    @csrf
                    <input type="text" name="name" value="{{ request('to') }}" placeholder="Nama Anda" required class="w-full border-gray-300 rounded focus:ring-amber-500 focus:border-amber-500 font-bold">
                    <select name="status" required class="w-full border-gray-300 rounded focus:ring-amber-500 focus:border-amber-500">
                        <option value="" disabled selected>Konfirmasi Kehadiran</option>
                        <option value="hadir">Hadir</option>
                        <option value="tidak_hadir">Tidak Hadir</option>
                    </select>
                    <textarea name="message" rows="3" placeholder="Tulis ucapan..." required class="w-full border-gray-300 rounded focus:ring-amber-500 focus:border-amber-500"></textarea>
                    <button type="submit" class="w-full bg-amber-800 text-white font-bold py-3 rounded hover:bg-amber-900 transition">KIRIM UCAPAN</button>
                </form>

                <div class="mt-8 h-64 overflow-y-auto space-y-4 pr-2 border-t pt-4">
                    @foreach($order->guests()->latest()->get() as $guest)
                    <div class="bg-amber-50 p-4 rounded-lg border border-amber-100">
                        <div class="flex justify-between items-center mb-1">
                            <p class="font-bold text-amber-900">{{ $guest->name }}</p>
                            <span class="text-[10px] text-gray-400">{{ $guest->created_at->diffForHumans() }}</span>
                        </div>
                        <p class="text-sm text-gray-600 italic">"{{ $guest->message }}"</p>
                    </div>
                    @endforeach
                </div>
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
    </script>
</body>
</html>