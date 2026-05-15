<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Wedding of {{ $order->groom_name }} & {{ $order->bride_name }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;600;700&family=Lato:wght@300;400&family=Allura&display=swap" rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        .font-gold { font-family: 'Cinzel', serif; color: #d4af37; }
        .font-script { font-family: 'Allura', cursive; color: #f9f1d8; }
        .font-body { font-family: 'Lato', sans-serif; color: #a0a0a0; }
        
        .bg-dark { background-color: #0a0a0a; }
        .gold-border { border-color: #d4af37; }
        .gold-gradient { background: linear-gradient(135deg, #d4af37 0%, #aa7c11 100%); }
        
        .envelope-wrapper { transition: transform 1.5s cubic-bezier(0.77, 0, 0.175, 1), opacity 1.5s ease; }
        .envelope-open { transform: translateY(-100%); opacity: 0; pointer-events: none; }
        .spin { animation: spin 4s linear infinite; }
        @keyframes spin { 100% { transform: rotate(360deg); } }

        .hero-cover {
            background-image: url('{{ $order->cover_image ? asset("storage/" . $order->cover_image) : "https://images.unsplash.com/photo-1511285560929-80b456fea0bc?q=80&w=2069&auto=format&fit=crop" }}');
            background-size: cover; background-position: center; background-attachment: fixed;
        }

        /* Custom Scrollbar untuk tema gelap */
        ::-webkit-scrollbar { width: 8px; }
        ::-webkit-scrollbar-track { background: #111; }
        ::-webkit-scrollbar-thumb { background: #d4af37; border-radius: 4px; }
    </style>
</head>
<body class="bg-dark font-body overflow-hidden" id="body">

    <!-- AUDIO PLAYER -->
    <audio id="bg-music" loop>
        <source src="{{ $order->music_url ?? 'https://www.soundhelix.com/examples/mp3/SoundHelix-Song-1.mp3' }}" type="audio/mpeg">
    </audio>
    <button id="music-btn" class="fixed bottom-6 left-6 bg-black/80 text-[#d4af37] p-3 rounded-full shadow-[0_0_15px_rgba(212,175,55,0.3)] z-40 hidden border border-[#d4af37] transition hover:scale-110">
        <i class="fas fa-compact-disc"></i>
    </button>

    <!-- AMPLOP DIGITAL -->
    <div id="envelope" class="envelope-wrapper fixed inset-0 z-50 flex items-center justify-center bg-[#111] border-[12px] gold-border">
        <div class="absolute inset-0 opacity-20" style="background-image: url('https://www.transparenttextures.com/patterns/stardust.png');"></div>
        <div class="text-center relative z-10 px-6 max-w-lg w-full">
            <div class="w-16 h-16 mx-auto mb-6 border border-[#d4af37] transform rotate-45 flex items-center justify-center bg-black/50 backdrop-blur">
                <span class="transform -rotate-45 font-gold text-2xl font-bold">{{ substr($order->groom_name, 0, 1) }}&{{ substr($order->bride_name, 0, 1) }}</span>
            </div>
            <p class="font-gold tracking-[0.3em] text-xs uppercase mb-4">We Invite You To Celebrate</p>
            <h1 class="font-script text-6xl md:text-8xl mb-6 drop-shadow-lg">{{ $order->groom_name }} & {{ $order->bride_name }}</h1>
            
            <div class="border-y border-[#d4af37]/30 py-6 my-8 bg-black/40 backdrop-blur-sm">
                <p class="text-xs tracking-widest text-[#a0a0a0] mb-2 uppercase">Kepada Yth:</p>
                <p class="text-2xl font-gold font-bold">{{ request()->query('to', 'Tamu Spesial') }}</p>
            </div>
            
            <button onclick="bukaUndangan()" class="gold-gradient text-black font-gold font-bold px-10 py-3 tracking-widest hover:brightness-110 transition shadow-[0_0_20px_rgba(212,175,55,0.5)]">
                BUKA UNDANGAN
            </button>
        </div>
    </div>

    <!-- KONTEN UTAMA -->
    <div id="main-content" class="opacity-0 transition-opacity duration-1000 pb-20">
        
        <!-- HERO SECTION -->
        <section class="h-screen hero-cover relative flex items-center justify-center">
            <div class="absolute inset-0 bg-black/70"></div>
            <div class="absolute inset-0 border-[20px] border-[#0a0a0a]"></div>
            <div class="relative z-10 text-center px-4" data-aos="fade-up" data-aos-duration="2000">
                <p class="font-gold tracking-[0.4em] mb-4 text-xs uppercase">The Wedding Celebration</p>
                <h2 class="font-script text-7xl md:text-9xl mb-6 drop-shadow-2xl">{{ $order->groom_name }} & {{ $order->bride_name }}</h2>
                <p class="font-gold text-xl tracking-[0.2em]">{{ $order->akad_datetime->translatedFormat('d . M . Y') }}</p>
            </div>
        </section>

        <!-- QUOTE -->
        @if($order->quote)
        <section class="py-24 px-6 text-center max-w-3xl mx-auto border-b border-[#222]">
            <div data-aos="zoom-in">
                <i class="fas fa-quote-right text-3xl text-[#d4af37] mb-6 block opacity-50"></i>
                <p class="font-body text-xl italic text-[#a0a0a0] leading-relaxed">"{{ $order->quote }}"</p>
            </div>
        </section>
        @endif

        <!-- PROFIL MEMPELAI -->
        <section class="py-24 px-6 relative border-b border-[#222] bg-[#0d0d0d]">
            <div class="max-w-5xl mx-auto text-center">
                <h2 class="font-gold text-4xl mb-16" data-aos="fade-up">The Bride & Groom</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-16">
                    <div data-aos="fade-right" class="p-8 border border-[#333] hover:border-[#d4af37] transition duration-500 relative group">
                        <div class="absolute inset-0 gold-gradient opacity-0 group-hover:opacity-5 transition duration-500"></div>
                        <h3 class="font-gold text-3xl mb-4 relative z-10">{{ $order->groom_name }}</h3>
                        <p class="text-sm tracking-widest text-[#666] uppercase mb-1 relative z-10">Son Of</p>
                        <p class="font-gold relative z-10">{{ $order->groom_parents ?? 'Mr. & Mrs.' }}</p>
                        @if($order->groom_ig)
                        <a href="https://instagram.com/{{ str_replace('@', '', $order->groom_ig) }}" target="_blank" class="inline-block mt-4 text-[#a0a0a0] hover:text-[#d4af37] text-sm relative z-10 transition"><i class="fab fa-instagram mr-2"></i>{{ $order->groom_ig }}</a>
                        @endif
                    </div>
                    <div data-aos="fade-left" class="p-8 border border-[#333] hover:border-[#d4af37] transition duration-500 relative group">
                        <div class="absolute inset-0 gold-gradient opacity-0 group-hover:opacity-5 transition duration-500"></div>
                        <h3 class="font-gold text-3xl mb-4 relative z-10">{{ $order->bride_name }}</h3>
                        <p class="text-sm tracking-widest text-[#666] uppercase mb-1 relative z-10">Daughter Of</p>
                        <p class="font-gold relative z-10">{{ $order->bride_parents ?? 'Mr. & Mrs.' }}</p>
                        @if($order->bride_ig)
                        <a href="https://instagram.com/{{ str_replace('@', '', $order->bride_ig) }}" target="_blank" class="inline-block mt-4 text-[#a0a0a0] hover:text-[#d4af37] text-sm relative z-10 transition"><i class="fab fa-instagram mr-2"></i>{{ $order->bride_ig }}</a>
                        @endif
                    </div>
                </div>
            </div>
        </section>

        <!-- KISAH CINTA (TIMELINE) -->
        @if($order->is_lovestory_active && $order->loveStories->count() > 0)
        <section class="py-24 px-6 bg-[#080808] border-b border-[#222]">
            <h2 class="font-gold text-4xl mb-16 text-center" data-aos="fade-up">Our Journey</h2>
            <div class="max-w-3xl mx-auto space-y-12">
                @foreach($order->loveStories as $index => $story)
                <div class="flex flex-col md:flex-row items-center gap-6" data-aos="fade-up" data-aos-delay="{{ $index * 100 }}">
                    <div class="md:w-1/4 text-center md:text-right">
                        <span class="font-gold text-2xl border-b border-[#d4af37] pb-1">{{ $story->year }}</span>
                    </div>
                    <div class="hidden md:block w-px h-16 bg-[#333] relative">
                        <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-3 h-3 bg-[#d4af37] rotate-45"></div>
                    </div>
                    <div class="md:w-3/4 text-center md:text-left bg-[#111] p-6 border border-[#222] hover:border-[#d4af37]/50 transition">
                        <h3 class="font-gold text-xl mb-2">{{ $story->title }}</h3>
                        <p class="text-sm text-[#888] leading-relaxed">{{ $story->story }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </section>
        @endif

        <!-- DETAIL ACARA -->
        <section class="py-24 px-6 text-center border-b border-[#222]">
            <h2 class="font-gold text-4xl mb-16" data-aos="fade-up">Event Details</h2>
            <div class="max-w-5xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-10">
                
                <!-- Akad -->
                <div class="border border-[#d4af37]/30 p-10 relative bg-[#0a0a0a]" data-aos="fade-right">
                    <div class="absolute top-0 left-0 w-6 h-6 border-t-2 border-l-2 gold-border"></div>
                    <div class="absolute top-0 right-0 w-6 h-6 border-t-2 border-r-2 gold-border"></div>
                    <div class="absolute bottom-0 left-0 w-6 h-6 border-b-2 border-l-2 gold-border"></div>
                    <div class="absolute bottom-0 right-0 w-6 h-6 border-b-2 border-r-2 gold-border"></div>

                    <h3 class="font-gold text-3xl mb-6 text-white">Holy Matrimony</h3>
                    <p class="font-gold text-lg mb-2">{{ $order->akad_datetime->translatedFormat('l, d F Y') }}</p>
                    <p class="text-[#a0a0a0] mb-6 uppercase tracking-widest text-sm">{{ $order->akad_datetime->format('H:i') }} WIB</p>
                    <p class="text-[#888] text-sm mb-8 h-10">{{ $order->akad_location }}</p>
                    <a href="https://maps.google.com/?q={{ urlencode($order->akad_location) }}" target="_blank" class="inline-block border border-[#d4af37] text-[#d4af37] px-6 py-2 text-xs font-gold tracking-widest hover:bg-[#d4af37] hover:text-black transition">VIEW MAP</a>
                </div>

                <!-- Resepsi -->
                <div class="border border-[#d4af37]/30 p-10 relative bg-[#0a0a0a]" data-aos="fade-left">
                    <div class="absolute top-0 left-0 w-6 h-6 border-t-2 border-l-2 gold-border"></div>
                    <div class="absolute top-0 right-0 w-6 h-6 border-t-2 border-r-2 gold-border"></div>
                    <div class="absolute bottom-0 left-0 w-6 h-6 border-b-2 border-l-2 gold-border"></div>
                    <div class="absolute bottom-0 right-0 w-6 h-6 border-b-2 border-r-2 gold-border"></div>

                    <h3 class="font-gold text-3xl mb-6 text-white">Wedding Reception</h3>
                    <p class="font-gold text-lg mb-2">{{ $order->resepsi_datetime->translatedFormat('l, d F Y') }}</p>
                    <p class="text-[#a0a0a0] mb-6 uppercase tracking-widest text-sm">{{ $order->resepsi_datetime->format('H:i') }} WIB</p>
                    <p class="text-[#888] text-sm mb-8 h-10">{{ $order->resepsi_location }}</p>
                    <a href="https://maps.google.com/?q={{ urlencode($order->resepsi_location) }}" target="_blank" class="inline-block border border-[#d4af37] text-[#d4af37] px-6 py-2 text-xs font-gold tracking-widest hover:bg-[#d4af37] hover:text-black transition">VIEW MAP</a>
                </div>

            </div>

            <!-- LIVE STREAM -->
            @if($order->live_stream_url)
            <div class="mt-16" data-aos="fade-up">
                <a href="{{ $order->live_stream_url }}" target="_blank" class="inline-block bg-[#111] border border-[#d4af37] text-[#d4af37] font-gold px-8 py-4 tracking-[0.2em] hover:bg-[#d4af37] hover:text-black transition">
                    <i class="fas fa-video mr-2"></i> JOIN LIVE STREAMING
                </a>
            </div>
            @endif

            <!-- COUNTDOWN -->
            <div class="flex justify-center gap-4 md:gap-8 font-gold mt-20" data-aos="zoom-in">
                <div class="bg-[#111] p-4 min-w-[80px] border border-[#222]"><span id="hari" class="text-3xl md:text-5xl block">00</span><span class="text-[10px] tracking-widest text-[#666]">DAYS</span></div>
                <div class="text-3xl md:text-5xl text-[#333] pt-2">:</div>
                <div class="bg-[#111] p-4 min-w-[80px] border border-[#222]"><span id="jam" class="text-3xl md:text-5xl block">00</span><span class="text-[10px] tracking-widest text-[#666]">HRS</span></div>
                <div class="text-3xl md:text-5xl text-[#333] pt-2">:</div>
                <div class="bg-[#111] p-4 min-w-[80px] border border-[#222]"><span id="menit" class="text-3xl md:text-5xl block">00</span><span class="text-[10px] tracking-widest text-[#666]">MINS</span></div>
                <div class="hidden md:block text-5xl text-[#333] pt-2">:</div>
                <div class="hidden md:block bg-[#111] p-4 min-w-[80px] border border-[#222]"><span id="detik" class="text-5xl block">00</span><span class="text-[10px] tracking-widest text-[#666]">SECS</span></div>
            </div>
        </section>

        <!-- GALERI FOTO -->
        @if($order->is_gallery_active && $order->galleries->count() > 0)
        <section class="py-24 px-6 bg-[#050505] border-b border-[#222]">
            <h2 class="font-gold text-4xl mb-16 text-center" data-aos="fade-up">Moments</h2>
            <div class="max-w-5xl mx-auto grid grid-cols-2 md:grid-cols-4 gap-4">
                @foreach($order->galleries as $gallery)
                <div data-aos="zoom-in" class="aspect-square overflow-hidden border border-[#333] group relative">
                    <div class="absolute inset-0 bg-[#d4af37]/20 opacity-0 group-hover:opacity-100 transition duration-300 z-10"></div>
                    <img src="{{ asset('storage/' . $gallery->image_path) }}" class="w-full h-full object-cover grayscale group-hover:grayscale-0 transition duration-500 group-hover:scale-110" alt="Gallery">
                </div>
                @endforeach
            </div>
        </section>
        @endif

        <!-- DIGITAL GIFT (ANGPAO) -->
        @if($order->is_angpao_active && $order->bank_account)
        <section class="py-24 px-6 text-center border-b border-[#222] bg-[#0a0a0a]">
            <div class="max-w-md mx-auto" data-aos="fade-up">
                <i class="fas fa-gift text-4xl text-[#d4af37] mb-6 block opacity-80"></i>
                <h2 class="font-gold text-3xl mb-6">Wedding Gift</h2>
                <p class="text-sm text-[#888] mb-8 leading-relaxed">Your blessing is the most meaningful gift to us. For those who wish to give a gift directly, you may send it to:</p>
                
                <div class="bg-[#111] border border-[#d4af37]/40 p-8 shadow-[0_0_15px_rgba(212,175,55,0.05)]">
                    <p class="font-gold text-xl mb-2">{{ $order->bank_name }}</p>
                    <p class="text-2xl tracking-[0.2em] text-white mb-2 font-light">{{ $order->bank_account }}</p>
                    <p class="text-sm text-[#888] mb-0 uppercase tracking-widest">{{ $order->bank_owner }}</p>
                </div>
            </div>
        </section>
        @endif

        <!-- RSVP & GUESTBOOK -->
        <section class="max-w-2xl mx-auto px-6 pt-24" data-aos="fade-up">
            <h2 class="font-gold text-3xl text-center mb-10">Guestbook & RSVP</h2>
            
            @if(session('success_rsvp'))
                <div class="bg-[#d4af37]/10 border border-[#d4af37] text-[#d4af37] p-4 mb-8 text-center text-sm font-gold tracking-widest">{{ session('success_rsvp') }}</div>
            @endif

            <div class="bg-[#111] p-8 md:p-12 border border-[#222]">
                <form action="{{ route('guest.store', $order->id) }}" method="POST" class="space-y-8">
                    @csrf
                    <div>
                        <input type="text" name="name" value="{{ request('to') }}" placeholder="FULL NAME" required class="w-full bg-transparent border-b border-[#444] border-t-0 border-x-0 focus:ring-0 focus:border-[#d4af37] text-white tracking-widest text-sm py-2 transition">
                    </div>
                    <div>
                        <select name="status" required class="w-full bg-transparent border-b border-[#444] border-t-0 border-x-0 focus:ring-0 focus:border-[#d4af37] text-[#888] tracking-widest text-sm py-2 transition appearance-none">
                            <option value="" disabled selected class="bg-[#111]">ATTENDANCE</option>
                            <option value="hadir" class="bg-[#111]">WILL ATTEND</option>
                            <option value="tidak_hadir" class="bg-[#111]">UNABLE TO ATTEND</option>
                        </select>
                    </div>
                    <div>
                        <textarea name="message" rows="4" placeholder="YOUR WISHES" required class="w-full bg-transparent border-b border-[#444] border-t-0 border-x-0 focus:ring-0 focus:border-[#d4af37] text-white tracking-widest text-sm py-2 transition resize-none"></textarea>
                    </div>
                    <button type="submit" class="w-full gold-gradient text-black font-gold font-bold py-4 tracking-[0.2em] hover:brightness-110 mt-4 transition">SEND WISHES</button>
                </form>
            </div>

            <!-- Menampilkan Ucapan -->
            <div class="mt-16 space-y-6">
                @foreach($order->guests()->latest()->get() as $guest)
                <div class="border-l-2 border-[#d4af37] pl-5 py-2">
                    <div class="flex justify-between items-baseline mb-2">
                        <p class="font-gold text-[#d4af37] tracking-widest text-sm">{{ $guest->name }}</p>
                        <span class="text-[10px] text-[#555] uppercase tracking-wider">{{ $guest->created_at->diffForHumans() }}</span>
                    </div>
                    <p class="font-body text-[#a0a0a0] leading-relaxed text-sm">"{{ $guest->message }}"</p>
                </div>
                @endforeach
            </div>
        </section>
        
        <div class="text-center mt-24 text-[#333] text-xs tracking-[0.3em] font-gold pb-10">
            <p>CREATED WITH UNDANGANPRO</p>
        </div>
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
            setTimeout(() => { AOS.init({ once: true, offset: 50 }); }, 500);
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
                ['hari','jam','menit','detik'].forEach(id => {
                    const el = document.getElementById(id);
                    if(el) el.innerHTML = "00";
                });
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