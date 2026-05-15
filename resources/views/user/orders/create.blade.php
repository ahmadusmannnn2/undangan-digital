<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Buat Undangan Premium: {{ $template->name }}</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-xl sm:rounded-xl p-8 border-t-4 border-indigo-600">
                
                @if ($errors->any())
                    <div class="mb-6 bg-red-50 border border-red-200 text-red-600 p-4 rounded-lg">
                        <ul class="list-disc pl-5">
                            @foreach ($errors->all() as $error) <li>{{ $error }}</li> @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('user.order.store', $template->id) }}" method="POST" enctype="multipart/form-data" class="space-y-10">
                    @csrf
                    
                    <!-- 1. Data Mempelai -->
                    <div>
                        <h3 class="text-xl font-bold text-gray-900 border-b pb-2 mb-6"><i class="fas fa-heart text-rose-500 mr-2"></i>1. Profil Mempelai</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <div class="bg-blue-50 p-6 rounded-xl border border-blue-100">
                                <h4 class="font-bold text-blue-800 mb-4 text-center border-b border-blue-200 pb-2">Mempelai Pria</h4>
                                <div class="space-y-4">
                                    <div><label class="text-xs font-bold text-gray-700">Nama Panggilan</label><input type="text" name="groom_name" class="w-full rounded-md border-gray-300" required></div>
                                    <div><label class="text-xs font-bold text-gray-700">Nama Orang Tua</label><input type="text" name="groom_parents" placeholder="Putra dari Bpk X & Ibu Y" class="w-full rounded-md border-gray-300" required></div>
                                    <div><label class="text-xs font-bold text-gray-700">Username Instagram (Opsional)</label><input type="text" name="groom_ig" placeholder="@username" class="w-full rounded-md border-gray-300"></div>
                                </div>
                            </div>
                            <div class="bg-pink-50 p-6 rounded-xl border border-pink-100">
                                <h4 class="font-bold text-pink-800 mb-4 text-center border-b border-pink-200 pb-2">Mempelai Wanita</h4>
                                <div class="space-y-4">
                                    <div><label class="text-xs font-bold text-gray-700">Nama Panggilan</label><input type="text" name="bride_name" class="w-full rounded-md border-gray-300" required></div>
                                    <div><label class="text-xs font-bold text-gray-700">Nama Orang Tua</label><input type="text" name="bride_parents" placeholder="Putri dari Bpk A & Ibu B" class="w-full rounded-md border-gray-300" required></div>
                                    <div><label class="text-xs font-bold text-gray-700">Username Instagram (Opsional)</label><input type="text" name="bride_ig" placeholder="@username" class="w-full rounded-md border-gray-300"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- 2. Rangkaian Acara -->
                    <div>
                        <h3 class="text-xl font-bold text-gray-900 border-b pb-2 mb-6"><i class="fas fa-calendar-alt text-indigo-500 mr-2"></i>2. Rangkaian Acara</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <div class="border border-gray-200 p-5 rounded-lg bg-gray-50">
                                <h4 class="font-bold text-gray-800 mb-3">Jadwal Akad Nikah / Pemberkatan</h4>
                                <div class="space-y-3">
                                    <div><label class="text-xs font-bold">Tanggal & Waktu</label><input type="datetime-local" name="akad_datetime" class="w-full rounded-md border-gray-300 text-sm" required></div>
                                    <div><label class="text-xs font-bold">Lokasi Lengkap</label><textarea name="akad_location" rows="2" class="w-full rounded-md border-gray-300 text-sm" required></textarea></div>
                                </div>
                            </div>
                            <div class="border border-gray-200 p-5 rounded-lg bg-gray-50">
                                <h4 class="font-bold text-gray-800 mb-3">Jadwal Resepsi</h4>
                                <div class="space-y-3">
                                    <div><label class="text-xs font-bold">Tanggal & Waktu</label><input type="datetime-local" name="resepsi_datetime" class="w-full rounded-md border-gray-300 text-sm" required></div>
                                    <div><label class="text-xs font-bold">Lokasi Lengkap</label><textarea name="resepsi_location" rows="2" class="w-full rounded-md border-gray-300 text-sm" required></textarea></div>
                                </div>
                            </div>
                        </div>
                        <div class="mt-4">
                            <label class="text-xs font-bold">Link Live Streaming (YouTube/Zoom) - Opsional</label>
                            <input type="url" name="live_stream_url" placeholder="https://youtube.com/..." class="w-full rounded-md border-gray-300 mt-1">
                        </div>
                    </div>

                    <!-- 3. Kisah Cinta (Love Story) -->
                    <div class="border border-indigo-200 rounded-xl p-6 bg-indigo-50/30">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="text-xl font-bold text-gray-900"><i class="fas fa-book-open text-amber-500 mr-2"></i>3. Kisah Cinta (Love Story)</h3>
                            <label class="flex items-center space-x-2 cursor-pointer bg-white px-3 py-1 rounded shadow-sm border border-gray-200">
                                <input type="checkbox" name="is_lovestory_active" value="1" checked class="rounded text-indigo-600">
                                <span class="text-sm font-bold text-gray-700">Tampilkan di Undangan</span>
                            </label>
                        </div>
                        <div id="love-story-container" class="space-y-4">
                            <!-- Input Pertama -->
                            <div class="grid grid-cols-1 md:grid-cols-12 gap-3 items-start bg-white p-4 rounded border border-gray-200">
                                <div class="md:col-span-2"><input type="text" name="ls_year[]" placeholder="Tahun (2018)" class="w-full rounded-md border-gray-300 text-sm"></div>
                                <div class="md:col-span-4"><input type="text" name="ls_title[]" placeholder="Judul (Awal Bertemu)" class="w-full rounded-md border-gray-300 text-sm"></div>
                                <div class="md:col-span-6"><textarea name="ls_story[]" rows="2" placeholder="Ceritakan singkat..." class="w-full rounded-md border-gray-300 text-sm"></textarea></div>
                            </div>
                        </div>
                        <button type="button" onclick="addLoveStory()" class="mt-3 text-sm text-indigo-600 font-bold bg-indigo-100 px-4 py-2 rounded hover:bg-indigo-200">+ Tambah Cerita Baru</button>
                    </div>

                    <!-- 4. Galeri Foto & Media -->
                    <div class="border border-indigo-200 rounded-xl p-6 bg-indigo-50/30">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="text-xl font-bold text-gray-900"><i class="fas fa-images text-teal-500 mr-2"></i>4. Galeri Foto & Media</h3>
                            <label class="flex items-center space-x-2 cursor-pointer bg-white px-3 py-1 rounded shadow-sm border border-gray-200">
                                <input type="checkbox" name="is_gallery_active" value="1" checked class="rounded text-indigo-600">
                                <span class="text-sm font-bold text-gray-700">Tampilkan Galeri</span>
                            </label>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 bg-white p-4 rounded border border-gray-200">
                            <div>
                                <label class="text-sm font-bold text-gray-700 block mb-2">Foto Cover (Utama)</label>
                                <input type="file" name="cover_image" accept="image/*" class="w-full text-sm border p-2 rounded bg-gray-50">
                            </div>
                            <div>
                                <label class="text-sm font-bold text-gray-700 block mb-2">Foto Galeri (Bisa pilih banyak foto)</label>
                                <input type="file" name="galleries[]" accept="image/*" multiple class="w-full text-sm border p-2 rounded bg-gray-50">
                            </div>
                            <div class="md:col-span-2">
                                <label class="text-sm font-bold text-gray-700 block mb-2">Link Lagu (MP3)</label>
                                <input type="url" name="music_url" placeholder="https://..." class="w-full rounded-md border-gray-300 text-sm">
                            </div>
                            <div class="md:col-span-2">
                                <label class="text-sm font-bold text-gray-700 block mb-2">Kutipan / Ayat Suci</label>
                                <textarea name="quote" rows="2" placeholder="Tulis kutipan indah di sini..." class="w-full rounded-md border-gray-300 text-sm"></textarea>
                            </div>
                        </div>
                    </div>

                    <!-- 5. Hadiah Digital (Angpao) -->
                    <div class="border border-indigo-200 rounded-xl p-6 bg-indigo-50/30">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="text-xl font-bold text-gray-900"><i class="fas fa-gift text-pink-500 mr-2"></i>5. Hadiah Digital (Angpao)</h3>
                            <label class="flex items-center space-x-2 cursor-pointer bg-white px-3 py-1 rounded shadow-sm border border-gray-200">
                                <input type="checkbox" name="is_angpao_active" value="1" checked class="rounded text-indigo-600">
                                <span class="text-sm font-bold text-gray-700">Tampilkan Angpao</span>
                            </label>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 bg-white p-4 rounded border border-gray-200">
                            <div><label class="text-xs font-bold">Nama Bank / E-Wallet</label><input type="text" name="bank_name" placeholder="BCA / DANA" class="w-full rounded-md border-gray-300 text-sm mt-1"></div>
                            <div><label class="text-xs font-bold">Nomor Rekening</label><input type="text" name="bank_account" placeholder="123456789" class="w-full rounded-md border-gray-300 text-sm mt-1"></div>
                            <div><label class="text-xs font-bold">Atas Nama</label><input type="text" name="bank_owner" placeholder="Nama Pemilik" class="w-full rounded-md border-gray-300 text-sm mt-1"></div>
                        </div>
                    </div>

                    <!-- 6. URL Link -->
                    <div class="bg-gray-900 p-6 rounded-xl border border-gray-800 text-white shadow-2xl">
                        <label class="block text-white text-lg font-bold mb-3"><i class="fas fa-link mr-2 text-indigo-400"></i>6. Tentukan Link Undangan Anda</label>
                        <div class="flex items-center">
                            <span class="bg-gray-700 border border-gray-600 border-r-0 rounded-l-md px-4 py-3 text-gray-300 font-mono">websiteundangan.com/</span>
                            <input type="text" name="domain_url" placeholder="romeo-juliet" class="w-full bg-white text-black border-0 rounded-r-md py-3 px-4 focus:ring-4 focus:ring-indigo-500 font-bold" required>
                        </div>
                    </div>

                    <div class="flex justify-end pt-4">
                        <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-4 px-10 rounded-full shadow-2xl transition-transform hover:scale-105 text-lg">
                            <i class="fas fa-paper-plane mr-2"></i> Selesaikan Pesanan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Script untuk Tambah Form Kisah Cinta Dinamis -->
    <script>
        function addLoveStory() {
            const container = document.getElementById('love-story-container');
            const row = document.createElement('div');
            row.className = 'grid grid-cols-1 md:grid-cols-12 gap-3 items-start bg-white p-4 rounded border border-gray-200 relative mt-2';
            row.innerHTML = `
                <button type="button" onclick="this.parentElement.remove()" class="absolute -top-2 -right-2 bg-red-500 text-white rounded-full w-6 h-6 flex items-center justify-center text-xs shadow hover:bg-red-600"><i class="fas fa-times"></i></button>
                <div class="md:col-span-2"><input type="text" name="ls_year[]" placeholder="Tahun" class="w-full rounded-md border-gray-300 text-sm"></div>
                <div class="md:col-span-4"><input type="text" name="ls_title[]" placeholder="Judul Cerita" class="w-full rounded-md border-gray-300 text-sm"></div>
                <div class="md:col-span-6"><textarea name="ls_story[]" rows="2" placeholder="Ceritakan singkat..." class="w-full rounded-md border-gray-300 text-sm"></textarea></div>
            `;
            container.appendChild(row);
        }
    </script>
</x-app-layout>