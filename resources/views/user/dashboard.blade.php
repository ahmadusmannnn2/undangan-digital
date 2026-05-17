<x-app-layout>
    <x-slot name="header">
        <h2 class="font-extrabold text-2xl text-slate-800 leading-tight tracking-tight flex items-center gap-2">
            <i class="fas fa-bolt text-amber-400"></i> Dashboard Utama
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-10">
            
            @if(session('success'))
            <div class="glass-card border-l-4 border-green-500 text-green-800 p-4 rounded-xl flex items-center shadow-lg" data-aos="fade-down">
                <i class="fas fa-check-circle text-2xl mr-3 text-green-500"></i>
                <span class="font-semibold">{{ session('success') }}</span>
            </div>
            @endif

            <!-- Section 1: Active Projects -->
            <div data-aos="fade-up" data-aos-duration="800">
                <div class="flex justify-between items-end mb-6 px-2">
                    <div>
                        <h3 class="text-2xl font-extrabold text-slate-800 tracking-tight">Proyek Undangan Anda</h3>
                        <p class="text-slate-500 text-sm mt-1">Kelola tautan dan pantau kehadiran tamu secara real-time.</p>
                    </div>
                </div>

                @if($orders->isEmpty())
                    <div class="glass-card rounded-2xl p-12 text-center border border-dashed border-indigo-200">
                        <div class="w-20 h-20 bg-indigo-50 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-folder-open text-3xl text-indigo-300"></i>
                        </div>
                        <h4 class="text-lg font-bold text-slate-700">Belum Ada Proyek Aktif</h4>
                        <p class="text-slate-500 mb-6">Pilih salah satu tema eksklusif di bawah untuk memulai.</p>
                        <a href="#katalog" class="inline-block bg-slate-900 text-white font-bold py-3 px-8 rounded-full shadow-lg hover:shadow-xl hover:-translate-y-1 transition duration-300">Buat Sekarang</a>
                    </div>
                @else
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                        @foreach($orders as $order)
                        <div class="glass-card rounded-2xl p-6 relative overflow-hidden group hover:shadow-[0_20px_40px_-15px_rgba(99,102,241,0.2)] hover:-translate-y-2 transition-all duration-500">
                            <!-- Dekorasi Latar -->
                            <div class="absolute -right-10 -top-10 w-32 h-32 bg-indigo-500 rounded-full mix-blend-multiply filter blur-3xl opacity-20 group-hover:opacity-40 transition-opacity duration-500"></div>
                            
                            <!-- Header Card -->
                            <div class="flex justify-between items-start mb-6 relative z-10">
                                <div>
                                    <span class="text-xs font-black tracking-widest uppercase text-indigo-500 mb-1 block">{{ $order->template->name }}</span>
                                    <h4 class="text-2xl font-extrabold text-slate-800">{{ $order->groom_name }} <span class="text-pink-400 font-normal">&</span> {{ $order->bride_name }}</h4>
                                </div>
                                @if($order->payment_status == 'success')
                                    <span class="bg-emerald-100 text-emerald-700 border border-emerald-200 text-xs font-extrabold px-3 py-1.5 rounded-full shadow-sm flex items-center gap-1"><i class="fas fa-circle text-[8px] text-emerald-500 animate-pulse"></i> AKTIF</span>
                                @else
                                    <span class="bg-amber-100 text-amber-700 border border-amber-200 text-xs font-extrabold px-3 py-1.5 rounded-full shadow-sm flex items-center gap-1"><i class="fas fa-spinner fa-spin text-[10px]"></i> MENUNGGU</span>
                                @endif
                            </div>
                            
                            @if($order->payment_status == 'success')
                            <div class="bg-white/50 backdrop-blur-sm p-5 rounded-xl border border-white/60 shadow-inner mb-5 relative z-10">
                                <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-3">Generator Tautan Tamu Khusus</label>
                                <div class="flex flex-col gap-3">
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <i class="fas fa-user text-indigo-300"></i>
                                        </div>
                                        <input type="text" id="guestName_{{ $order->id }}" placeholder="Ketik nama tamu..." class="w-full pl-10 pr-4 py-3 bg-white/80 border border-slate-200 rounded-lg text-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-shadow">
                                    </div>
                                    <div class="flex gap-3">
                                        <button onclick="generateLink('{{ url('/' . $order->domain_url) }}', {{ $order->id }})" class="flex-1 bg-white hover:bg-slate-50 text-slate-700 border border-slate-200 py-2.5 rounded-lg text-sm font-bold shadow-sm flex items-center justify-center transition hover:-translate-y-0.5">
                                            <i class="fas fa-link mr-2 text-indigo-500"></i> Salin
                                        </button>
                                        <button onclick="shareToWA('{{ url('/' . $order->domain_url) }}', {{ $order->id }}, '{{ $order->groom_name }}', '{{ $order->bride_name }}')" class="flex-1 bg-gradient-to-r from-emerald-400 to-emerald-500 hover:from-emerald-500 hover:to-emerald-600 text-white py-2.5 rounded-lg text-sm font-bold shadow-md shadow-emerald-500/30 flex items-center justify-center transition hover:-translate-y-0.5">
                                            <i class="fab fa-whatsapp mr-2 text-lg"></i> Kirim WA
                                        </button>
                                    </div>
                                </div>
                            </div>
                            
                            <a href="{{ route('user.guests.index', $order->id) }}" class="group/btn block w-full bg-slate-900 hover:bg-indigo-600 text-white text-center font-bold py-3.5 rounded-xl transition-all duration-300 shadow-lg hover:shadow-indigo-500/30 relative z-10 overflow-hidden">
                                <span class="relative z-10 flex items-center justify-center">
                                    <i class="fas fa-book-open mr-2 group-hover/btn:scale-110 transition-transform"></i> Buka Buku Tamu <span class="ml-2 bg-white/20 px-2 py-0.5 rounded-md text-xs">{{ $order->guests->count() }}</span>
                                </span>
                            </a>
                            @else
                            <div class="bg-white/40 p-6 rounded-xl border border-dashed border-amber-300 text-center relative z-10">
                                <div class="w-12 h-12 bg-amber-100 rounded-full flex items-center justify-center mx-auto mb-3">
                                    <i class="fas fa-clock text-xl text-amber-500"></i>
                                </div>
                                <h5 class="font-bold text-slate-800">Verifikasi Pembayaran</h5>
                                <p class="text-xs text-slate-600 mt-1">Admin kami sedang memproses pesanan Anda. Tautan akan segera aktif.</p>
                            </div>
                            @endif
                        </div>
                        @endforeach
                    </div>
                @endif
            </div>

            <!-- Section 2: Katalog Template Ultra-Modern -->
            <div id="katalog" class="pt-8" data-aos="fade-up" data-aos-duration="1000">
                <div class="text-center mb-10">
                    <h3 class="text-3xl font-extrabold text-slate-800 tracking-tight">Koleksi Tema Eksklusif</h3>
                    <p class="text-slate-500 mt-2 max-w-xl mx-auto">Dirancang oleh desainer profesional dengan animasi yang memanjakan mata.</p>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($templates as $template)
                    <div class="glass-card rounded-2xl p-4 group hover:shadow-2xl transition-all duration-500 border border-white/60">
                        <div class="relative h-60 rounded-xl overflow-hidden mb-5 bg-slate-200">
                            @if($template->preview_image)
                                <img src="{{ asset('storage/' . $template->preview_image) }}" alt="Preview" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700 ease-in-out">
                            @else
                                <div class="w-full h-full flex items-center justify-center">
                                    <i class="fas fa-image text-4xl text-slate-300"></i>
                                </div>
                            @endif
                            <div class="absolute inset-0 bg-gradient-to-t from-slate-900/80 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-end p-4">
                                <a href="{{ route('template.preview', $template->id) }}" target="_blank" class="text-white text-sm font-bold flex items-center hover:underline">
                                    <i class="fas fa-play-circle mr-2 text-xl"></i> Lihat Demo Langsung
                                </a>
                            </div>
                            <div class="absolute top-3 right-3 bg-white/90 backdrop-blur-sm text-slate-900 text-xs font-black px-3 py-1.5 rounded-full shadow-lg">
                                Rp {{ number_format($template->price, 0, ',', '.') }}
                            </div>
                        </div>
                        <div class="px-2 pb-2">
                            <h4 class="font-extrabold text-xl text-slate-800 mb-1">{{ $template->name }}</h4>
                            <p class="text-slate-500 text-sm mb-6 h-10 line-clamp-2">{{ $template->description ?? 'Template modern dengan animasi mulus dan fitur lengkap.' }}</p>
                            
                            <a href="{{ route('user.order.create', $template->id) }}" class="block w-full text-center bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-500 hover:to-purple-500 text-white font-bold py-3 rounded-xl shadow-md shadow-indigo-500/30 transition-transform hover:-translate-y-1">
                                Pilih Tema Ini
                            </a>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

        </div>
    </div>

    <!-- Skrip JS tetap sama -->
    <script>
        function generateLink(baseUrl, orderId) {
            let guestName = document.getElementById('guestName_' + orderId).value;
            if(!guestName) { alert('Silakan masukkan nama tamu terlebih dahulu!'); return; }
            let finalLink = baseUrl + '?to=' + encodeURIComponent(guestName);
            navigator.clipboard.writeText(finalLink).then(() => { alert('Tautan berhasil disalin!\n' + finalLink); });
        }

        function shareToWA(baseUrl, orderId, groom, bride) {
            let guestName = document.getElementById('guestName_' + orderId).value;
            if(!guestName) { alert('Silakan masukkan nama tamu terlebih dahulu agar sapaan sesuai!'); return; }
            let finalLink = baseUrl + '?to=' + encodeURIComponent(guestName);
            let message = `*Undangan Pernikahan* 💍\n\nKepada Yth. Bapak/Ibu/Saudara/i:\n*${guestName}*\n\nTanpa mengurangi rasa hormat, perkenankan kami mengundang Bapak/Ibu/Saudara/i untuk hadir dan memberikan doa restu pada acara pernikahan kami.\n\nDetail acara dan lokasi dapat dilihat pada tautan undangan digital berikut:\n${finalLink}\n\nMerupakan suatu kehormatan dan kebahagiaan bagi kami apabila Bapak/Ibu/Saudara/i berkenan hadir.\n\nSalam hangat,\n*${groom} & ${bride}*`;
            window.open('https://api.whatsapp.com/send?text=' + encodeURIComponent(message), '_blank');
        }
    </script>
</x-app-layout>