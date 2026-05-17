<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-extrabold text-2xl text-slate-800 leading-tight tracking-tight flex items-center gap-2">
                <i class="fas fa-layer-group text-indigo-500"></i> Koleksi Tema
            </h2>
            <a href="{{ route('admin.templates.create') }}" class="bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-500 hover:to-purple-500 text-white font-bold py-2 px-6 rounded-full shadow-lg shadow-indigo-500/30 transition-transform hover:-translate-y-0.5 text-sm flex items-center">
                <i class="fas fa-plus mr-2"></i> Tambah Tema Baru
            </a>
        </div>
    </x-slot>

    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            
            @if(session('success'))
            <div class="glass-card border-l-4 border-green-500 text-green-800 p-4 rounded-xl flex items-center shadow-lg" data-aos="fade-down">
                <i class="fas fa-check-circle text-2xl mr-3 text-green-500"></i>
                <span class="font-semibold">{{ session('success') }}</span>
            </div>
            @endif

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($templates as $template)
                <div class="glass-card rounded-3xl p-4 group border border-white/60 hover:shadow-2xl hover:shadow-indigo-500/10 transition-all duration-300" data-aos="fade-up">
                    <div class="relative h-56 rounded-2xl overflow-hidden mb-4 bg-slate-200">
                        @if($template->preview_image)
                            <img src="{{ asset('storage/' . $template->preview_image) }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                        @else
                            <div class="w-full h-full flex items-center justify-center"><i class="fas fa-image text-4xl text-slate-300"></i></div>
                        @endif
                        <div class="absolute top-3 right-3 bg-white/90 backdrop-blur-sm text-slate-900 text-xs font-black px-3 py-1.5 rounded-full shadow-lg">
                            Rp {{ number_format($template->price, 0, ',', '.') }}
                        </div>
                    </div>
                    <div class="px-2">
                        <h4 class="font-extrabold text-xl text-slate-800 mb-1">{{ $template->name }}</h4>
                        <p class="text-xs font-mono text-indigo-500 bg-indigo-50 inline-block px-2 py-1 rounded mb-4">Path: {{ $template->view_path }}</p>
                        
                        <div class="flex gap-2 mt-2 border-t border-slate-200/50 pt-4">
                            <form action="{{ route('admin.templates.destroy', $template) }}" method="POST" class="w-full" onsubmit="return confirm('Yakin ingin menghapus tema ini secara permanen?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="w-full bg-red-50 hover:bg-red-100 text-red-600 font-bold py-2 rounded-xl transition text-sm flex items-center justify-center border border-red-100">
                                    <i class="fas fa-trash-alt mr-2"></i> Hapus Tema
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-span-full glass-card rounded-3xl p-12 text-center border border-dashed border-indigo-200">
                    <i class="fas fa-box-open text-5xl text-indigo-200 mb-4"></i>
                    <h4 class="text-xl font-bold text-slate-700">Belum Ada Tema</h4>
                    <p class="text-slate-500 mt-2">Tambahkan tema pertama Anda agar pelanggan bisa mulai memesan.</p>
                </div>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>