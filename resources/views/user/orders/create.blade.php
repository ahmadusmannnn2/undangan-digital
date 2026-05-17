<x-app-layout>
    <x-slot name="header">
        <h2 class="font-extrabold text-2xl text-slate-800 leading-tight tracking-tight flex items-center gap-3">
            <i class="fas fa-magic text-indigo-500"></i> Konfigurasi Tema: <span class="text-indigo-600">{{ $template->name }}</span>
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            
            <div class="glass-card sm:rounded-3xl p-8 md:p-12 relative overflow-hidden">
                <!-- Dekorasi Latar Form -->
                <div class="absolute -top-20 -right-20 w-64 h-64 bg-purple-400 rounded-full mix-blend-multiply filter blur-3xl opacity-20"></div>
                <div class="absolute -bottom-20 -left-20 w-64 h-64 bg-indigo-400 rounded-full mix-blend-multiply filter blur-3xl opacity-20"></div>

                @if ($errors->any())
                    <div class="mb-8 glass bg-red-50/50 border-l-4 border-red-500 text-red-700 p-5 rounded-xl shadow-sm relative z-10">
                        <div class="flex items-center mb-2 font-bold"><i class="fas fa-exclamation-circle mr-2"></i> Terdapat Kesalahan:</div>
                        <ul class="list-disc pl-6 text-sm space-y-1">
                            @foreach ($errors->all() as $error) <li>{{ $error }}</li> @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('user.order.store', $template->id) }}" method="POST" enctype="multipart/form-data" class="space-y-12 relative z-10">
                    @csrf
                    
                    <!-- 1. Data Mempelai -->
                    <div class="relative">
                        <div class="flex items-center gap-3 mb-6 border-b border-slate-200/50 pb-3">
                            <div class="w-10 h-10 rounded-full bg-gradient-to-tr from-pink-500 to-rose-400 flex items-center justify-center text-white shadow-lg"><i class="fas fa-heart"></i></div>
                            <h3 class="text-2xl font-extrabold text-slate-800">Profil Mempelai</h3>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <div class="bg-white/40 backdrop-blur-md p-6 rounded-2xl border border-white/60 shadow-sm hover:shadow-md transition">
                                <h4 class="font-bold text-slate-700 mb-5 flex items-center gap-2"><i class="fas fa-mars text-blue-500"></i> Mempelai Pria</h4>
                                <div class="space-y-4 text-sm">
                                    <div><label class="font-bold text-slate-600">Nama Panggilan</label><input type="text" name="groom_name" class="mt-1 w-full rounded-xl border-slate-200 bg-white/60 focus:bg-white focus:ring-indigo-500 transition" required></div>
                                    <div><label class="font-bold text-slate-600">Nama Orang Tua</label><input type="text" name="groom_parents" placeholder="Putra dari Bpk X & Ibu Y" class="mt-1 w-full rounded-xl border-slate-200 bg-white/60 focus:bg-white focus:ring-indigo-500 transition" required></div>
                                    <div><label class="font-bold text-slate-600">Username Instagram</label><input type="text" name="groom_ig" placeholder="@username" class="mt-1 w-full rounded-xl border-slate-200 bg-white/60 focus:bg-white focus:ring-indigo-500 transition"></div>
                                </div>
                            </div>
                            <div class="bg-white/40 backdrop-blur-md p-6 rounded-2xl border border-white/60 shadow-sm hover:shadow-md transition">
                                <h4 class="font-bold text-slate-700 mb-5 flex items-center gap-2"><i class="fas fa-venus text-pink-500"></i> Mempelai Wanita</h4>
                                <div class="space-y-4 text-sm">
                                    <div><label class="font-bold text-slate-600">Nama Panggilan</label><input type="text" name="bride_name" class="mt-1 w-full rounded-xl border-slate-200 bg-white/60 focus:bg-white focus:ring-indigo-500 transition" required></div>
                                    <div><label class="font-bold text-slate-600">Nama Orang Tua</label><input type="text" name="bride_parents" placeholder="Putri dari Bpk A & Ibu B" class="mt-1 w-full rounded-xl border-slate-200 bg-white/60 focus:bg-white focus:ring-indigo-500 transition" required></div>
                                    <div><label class="font-bold text-slate-600">Username Instagram</label><input type="text" name="bride_ig" placeholder="@username" class="mt-1 w-full rounded-xl border-slate-200 bg-white/60 focus:bg-white focus:ring-indigo-500 transition"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- 2. Rangkaian Acara -->
                    <div class="relative">
                        <div class="flex items-center gap-3 mb-6 border-b border-slate-200/50 pb-3">
                            <div class="w-10 h-10 rounded-full bg-gradient-to-tr from-indigo-500 to-purple-500 flex items-center justify-center text-white shadow-lg"><i class="fas fa-calendar-alt"></i></div>
                            <h3 class="text-2xl font-extrabold text-slate-800">Rangkaian Acara</h3>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <div class="bg-white/40 backdrop-blur-md p-6 rounded-2xl border border-white/60 shadow-sm transition hover:shadow-md">
                                <h4 class="font-bold text-slate-700 mb-4 text-sm uppercase tracking-wider">Jadwal Akad / Pemberkatan</h4>
                                <div class="space-y-4 text-sm">
                                    <div><label class="font-bold text-slate-600">Tanggal & Waktu</label><input type="datetime-local" name="akad_datetime" class="mt-1 w-full rounded-xl border-slate-200 bg-white/60 focus:bg-white focus:ring-indigo-500" required></div>
                                    <div><label class="font-bold text-slate-600">Lokasi Lengkap</label><textarea name="akad_location" rows="3" class="mt-1 w-full rounded-xl border-slate-200 bg-white/60 focus:bg-white focus:ring-indigo-500 resize-none" required></textarea></div>
                                </div>
                            </div>
                            <div class="bg-white/40 backdrop-blur-md p-6 rounded-2xl border border-white/60 shadow-sm transition hover:shadow-md">
                                <h4 class="font-bold text-slate-700 mb-4 text-sm uppercase tracking-wider">Jadwal Resepsi</h4>
                                <div class="space-y-4 text-sm">
                                    <div><label class="font-bold text-slate-600">Tanggal & Waktu</label><input type="datetime-local" name="resepsi_datetime" class="mt-1 w-full rounded-xl border-slate-200 bg-white/60 focus:bg-white focus:ring-indigo-500" required></div>
                                    <div><label class="font-bold text-slate-600">Lokasi Lengkap</label><textarea name="resepsi_location" rows="3" class="mt-1 w-full rounded-xl border-slate-200 bg-white/60 focus:bg-white focus:ring-indigo-500 resize-none" required></textarea></div>
                                </div>
                            </div>
                        </div>
                        <div class="mt-6 bg-white/40 backdrop-blur-md p-5 rounded-xl border border-white/60">
                            <label class="font-bold text-slate-600 text-sm"><i class="fas fa-video text-red-500 mr-2"></i>Link Live Streaming (YouTube/Zoom) - Opsional</label>
                            <input type="url" name="live_stream_url" placeholder="https://youtube.com/..." class="mt-2 w-full rounded-xl border-slate-200 bg-white/60 focus:bg-white focus:ring-indigo-500 text-sm">
                        </div>
                    </div>

                    <!-- 3. Kisah Cinta & Media -->
                    <div class="relative">
                        <div class="flex items-center justify-between mb-6 border-b border-slate-200/50 pb-3">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-full bg-gradient-to-tr from-amber-400 to-orange-500 flex items-center justify-center text-white shadow-lg"><i class="fas fa-book-open"></i></div>
                                <h3 class="text-2xl font-extrabold text-slate-800">Media & Kisah</h3>
                            </div>
                        </div>
                        
                        <div class="space-y-6">
                            <!-- Toggle Kisah Cinta -->
                            <div class="bg-white/40 backdrop-blur-md p-6 rounded-2xl border border-white/60 shadow-sm">
                                <div class="flex justify-between items-center mb-4">
                                    <h4 class="font-bold text-slate-700">Kisah Cinta (Timeline)</h4>
                                    <label class="relative inline-flex items-center cursor-pointer">
                                        <input type="checkbox" name="is_lovestory_active" value="1" checked class="sr-only peer">
                                        <div class="w-11 h-6 bg-slate-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-indigo-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-indigo-600"></div>
                                        <span class="ml-3 text-sm font-bold text-slate-600">Aktifkan</span>
                                    </label>
                                </div>
                                <div id="love-story-container" class="space-y-4">
                                    <div class="grid grid-cols-1 md:grid-cols-12 gap-3 items-start bg-white/50 p-4 rounded-xl border border-white/60">
                                        <div class="md:col-span-2"><input type="text" name="ls_year[]" placeholder="Tahun (2018)" class="w-full rounded-lg border-slate-200 bg-white focus:ring-indigo-500 text-sm"></div>
                                        <div class="md:col-span-4"><input type="text" name="ls_title[]" placeholder="Judul Cerita" class="w-full rounded-lg border-slate-200 bg-white focus:ring-indigo-500 text-sm"></div>
                                        <div class="md:col-span-6"><textarea name="ls_story[]" rows="2" placeholder="Ceritakan singkat..." class="w-full rounded-lg border-slate-200 bg-white focus:ring-indigo-500 text-sm resize-none"></textarea></div>
                                    </div>
                                </div>
                                <button type="button" onclick="addLoveStory()" class="mt-4 text-sm text-indigo-600 font-bold bg-indigo-50/50 hover:bg-indigo-100 px-4 py-2 rounded-lg transition border border-indigo-100"><i class="fas fa-plus mr-1"></i> Tambah Cerita</button>
                            </div>

                            <!-- Galeri & Lainnya -->
                            <div class="bg-white/40 backdrop-blur-md p-6 rounded-2xl border border-white/60 shadow-sm">
                                <div class="flex justify-between items-center mb-6">
                                    <h4 class="font-bold text-slate-700">Galeri Foto</h4>
                                    <label class="relative inline-flex items-center cursor-pointer">
                                        <input type="checkbox" name="is_gallery_active" value="1" checked class="sr-only peer">
                                        <div class="w-11 h-6 bg-slate-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-indigo-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-indigo-600"></div>
                                    </label>
                                </div>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div>
                                        <label class="text-sm font-bold text-slate-600 block mb-2">Foto Cover Utama</label>
                                        <input type="file" name="cover_image" accept="image/*" class="w-full text-sm border-slate-200 border rounded-xl bg-white p-2 focus:ring-indigo-500 file:bg-indigo-50 file:text-indigo-700 file:border-0 file:px-4 file:py-1 file:rounded-full file:font-bold file:mr-4">
                                    </div>
                                    <div>
                                        <label class="text-sm font-bold text-slate-600 block mb-2">Foto Galeri (Pilih banyak)</label>
                                        <input type="file" name="galleries[]" accept="image/*" multiple class="w-full text-sm border-slate-200 border rounded-xl bg-white p-2 focus:ring-indigo-500 file:bg-indigo-50 file:text-indigo-700 file:border-0 file:px-4 file:py-1 file:rounded-full file:font-bold file:mr-4">
                                    </div>
                                    <div class="md:col-span-2">
                                        <label class="text-sm font-bold text-slate-600 block mb-2"><i class="fas fa-music text-slate-400 mr-2"></i>Link Lagu (URL MP3)</label>
                                        <input type="url" name="music_url" placeholder="https://..." class="w-full rounded-xl border-slate-200 bg-white/60 focus:bg-white text-sm focus:ring-indigo-500">
                                    </div>
                                    <div class="md:col-span-2">
                                        <label class="text-sm font-bold text-slate-600 block mb-2">Kutipan / Ayat Suci</label>
                                        <textarea name="quote" rows="2" placeholder="Tulis kutipan indah di sini..." class="w-full rounded-xl border-slate-200 bg-white/60 focus:bg-white text-sm focus:ring-indigo-500 resize-none"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- 4. Hadiah Digital & URL -->
                    <div class="relative grid grid-cols-1 md:grid-cols-2 gap-8 border-t border-slate-200/50 pt-8">
                        <div class="bg-white/40 backdrop-blur-md p-6 rounded-2xl border border-white/60 shadow-sm">
                            <div class="flex justify-between items-center mb-6">
                                <h4 class="font-bold text-slate-800 flex items-center gap-2"><i class="fas fa-gift text-emerald-500 text-xl"></i> Angpao Digital</h4>
                                <label class="relative inline-flex items-center cursor-pointer">
                                    <input type="checkbox" name="is_angpao_active" value="1" checked class="sr-only peer">
                                    <div class="w-11 h-6 bg-slate-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-emerald-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-emerald-500"></div>
                                </label>
                            </div>
                            <div class="space-y-4 text-sm">
                                <div><label class="font-bold text-slate-600">Bank / E-Wallet</label><input type="text" name="bank_name" placeholder="BCA / DANA" class="mt-1 w-full rounded-xl border-slate-200 bg-white/60 focus:bg-white focus:ring-indigo-500"></div>
                                <div><label class="font-bold text-slate-600">Nomor Rekening</label><input type="text" name="bank_account" placeholder="123456789" class="mt-1 w-full rounded-xl border-slate-200 bg-white/60 focus:bg-white focus:ring-indigo-500"></div>
                                <div><label class="font-bold text-slate-600">Atas Nama</label><input type="text" name="bank_owner" placeholder="Nama Pemilik" class="mt-1 w-full rounded-xl border-slate-200 bg-white/60 focus:bg-white focus:ring-indigo-500"></div>
                            </div>
                        </div>

                        <div class="bg-gradient-to-br from-indigo-900 to-slate-900 p-8 rounded-2xl border border-indigo-800 text-white shadow-2xl relative overflow-hidden flex flex-col justify-center">
                            <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')] opacity-10"></div>
                            <h4 class="font-extrabold text-2xl mb-2 relative z-10">Tentukan Tautan Anda</h4>
                            <p class="text-indigo-200 text-sm mb-6 relative z-10">Pilih nama unik untuk undangan digital Anda.</p>
                            
                            <div class="flex items-center relative z-10 bg-black/30 p-2 rounded-xl border border-white/10 backdrop-blur-sm focus-within:border-indigo-400 focus-within:ring-2 focus-within:ring-indigo-400/50 transition">
                                <span class="text-slate-400 font-mono text-sm pl-3 pr-1">undanganpro.com/</span>
                                <input type="text" name="domain_url" placeholder="romeo-juliet" class="w-full bg-transparent border-0 text-white font-bold placeholder-slate-500 focus:ring-0 px-2" required>
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-end pt-8">
                        <button type="submit" class="bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-500 hover:to-purple-500 text-white font-extrabold text-lg py-4 px-12 rounded-full shadow-lg shadow-indigo-500/30 transition-all hover:scale-105 hover:shadow-indigo-500/50 flex items-center">
                            Selesaikan Pesanan <i class="fas fa-rocket ml-3"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function addLoveStory() {
            const container = document.getElementById('love-story-container');
            const row = document.createElement('div');
            row.className = 'grid grid-cols-1 md:grid-cols-12 gap-3 items-start bg-white/50 p-4 rounded-xl border border-white/60 relative mt-3 animate-[fade-in_0.3s_ease-out]';
            row.innerHTML = `
                <button type="button" onclick="this.parentElement.remove()" class="absolute -top-3 -right-3 bg-red-500 text-white rounded-full w-7 h-7 flex items-center justify-center text-xs shadow-lg hover:bg-red-600 transition hover:scale-110"><i class="fas fa-times"></i></button>
                <div class="md:col-span-2"><input type="text" name="ls_year[]" placeholder="Tahun" class="w-full rounded-lg border-slate-200 bg-white focus:ring-indigo-500 text-sm"></div>
                <div class="md:col-span-4"><input type="text" name="ls_title[]" placeholder="Judul Cerita" class="w-full rounded-lg border-slate-200 bg-white focus:ring-indigo-500 text-sm"></div>
                <div class="md:col-span-6"><textarea name="ls_story[]" rows="2" placeholder="Ceritakan singkat..." class="w-full rounded-lg border-slate-200 bg-white focus:ring-indigo-500 text-sm resize-none"></textarea></div>
            `;
            container.appendChild(row);
        }
    </script>
</x-app-layout>