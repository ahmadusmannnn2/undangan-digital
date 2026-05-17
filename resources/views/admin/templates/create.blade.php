<x-app-layout>
    <x-slot name="header">
        <h2 class="font-extrabold text-2xl text-slate-800 leading-tight tracking-tight flex items-center gap-2">
            <i class="fas fa-paint-brush text-indigo-500"></i> Buat Tema Baru
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="glass-card sm:rounded-3xl p-8 relative overflow-hidden" data-aos="fade-up">
                <div class="absolute -top-20 -right-20 w-64 h-64 bg-indigo-400 rounded-full mix-blend-multiply filter blur-3xl opacity-20"></div>

                <form action="{{ route('admin.templates.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6 relative z-10">
                    @csrf
                    
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2">Nama Tema</label>
                        <input type="text" name="name" class="w-full rounded-xl border-slate-200 bg-white/60 focus:bg-white focus:ring-indigo-500 transition" placeholder="Contoh: Elegant Floral" required>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-bold text-slate-700 mb-2">Harga (Rp)</label>
                            <input type="number" name="price" class="w-full rounded-xl border-slate-200 bg-white/60 focus:bg-white focus:ring-indigo-500 transition" placeholder="150000" required>
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-slate-700 mb-2">Path File View</label>
                            <input type="text" name="view_path" class="w-full rounded-xl border-slate-200 bg-white/60 focus:bg-white focus:ring-indigo-500 transition font-mono text-sm" placeholder="templates.floral" required>
                            <p class="text-xs text-slate-500 mt-1">Gunakan format folder.namafile (tanpa .blade.php)</p>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2">Deskripsi Singkat</label>
                        <textarea name="description" rows="2" class="w-full rounded-xl border-slate-200 bg-white/60 focus:bg-white focus:ring-indigo-500 transition resize-none" placeholder="Tema bernuansa bunga putih elegan..."></textarea>
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2">Preview Gambar (Thumbnail)</label>
                        <div class="w-full bg-white/50 border border-dashed border-slate-300 rounded-xl p-4 flex items-center justify-center hover:bg-white transition cursor-pointer">
                            <input type="file" name="preview_image" accept="image/*" class="w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-bold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 cursor-pointer">
                        </div>
                    </div>

                    <div class="flex justify-end pt-4 border-t border-slate-200/50">
                        <a href="{{ route('admin.templates.index') }}" class="text-slate-500 hover:text-slate-700 font-bold py-3 px-6 mr-4 transition">Batal</a>
                        <button type="submit" class="bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-500 hover:to-purple-500 text-white font-bold py-3 px-8 rounded-full shadow-lg transition-transform hover:-translate-y-0.5">
                            Simpan Tema
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>