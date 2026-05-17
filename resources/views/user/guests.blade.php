<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Buku Tamu: {{ $order->groom_name }} & {{ $order->bride_name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <a href="{{ route('user.dashboard') }}" class="text-indigo-600 hover:text-indigo-800 font-semibold mb-6 inline-block transition">&larr; Kembali ke Dashboard</a>
            
            @if(session('success'))
            <div class="mb-6 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg relative shadow-sm">
                {{ session('success') }}
            </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-xl p-8 border-t-4 border-indigo-600">
                <div class="flex justify-between items-center mb-6 border-b pb-4">
                    <h3 class="text-2xl font-bold text-gray-800">Daftar Kehadiran & Ucapan</h3>
                    <span class="bg-indigo-100 text-indigo-800 font-bold px-4 py-2 rounded-full text-sm">Total: {{ $guests->count() }} Tamu</span>
                </div>
                
                @if($guests->isEmpty())
                    <div class="text-center py-10 bg-gray-50 rounded-lg border-2 border-dashed border-gray-300">
                        <i class="fas fa-envelope-open-text text-4xl text-gray-300 mb-3 block"></i>
                        <p class="text-gray-500 font-semibold">Belum ada tamu yang mengisi buku tamu.</p>
                        <p class="text-sm text-gray-400">Silakan sebar link undangan Anda.</p>
                    </div>
                @else
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        @foreach($guests as $guest)
                        <div class="border border-gray-200 rounded-xl p-5 bg-gray-50 shadow-sm relative group hover:border-indigo-300 transition">
                            
                            <!-- Tombol Hapus (Muncul saat di-hover) -->
                            <form action="{{ route('user.guests.destroy', $guest->id) }}" method="POST" class="absolute top-4 right-4 opacity-0 group-hover:opacity-100 transition" onsubmit="return confirm('Yakin ingin menghapus ucapan dari {{ $guest->name }}?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="text-red-500 hover:text-red-700 bg-red-100 hover:bg-red-200 w-8 h-8 rounded-full flex items-center justify-center transition" title="Hapus Ucapan">
                                    <i class="fas fa-trash-alt text-xs"></i>
                                </button>
                            </form>

                            <div class="flex items-center mb-3">
                                <div class="w-10 h-10 rounded-full bg-indigo-100 text-indigo-700 flex items-center justify-center font-bold text-lg mr-3 uppercase">
                                    {{ substr($guest->name, 0, 1) }}
                                </div>
                                <div>
                                    <h4 class="font-bold text-md text-gray-800">{{ $guest->name }}</h4>
                                    <p class="text-xs text-gray-400">{{ $guest->created_at->diffForHumans() }}</p>
                                </div>
                            </div>
                            
                            <p class="text-gray-700 italic mb-4">"{{ $guest->message }}"</p>
                            
                            <span class="px-3 py-1 text-xs font-bold rounded-full border 
                                @if($guest->status == 'hadir') bg-green-50 text-green-700 border-green-200
                                @elseif($guest->status == 'tidak_hadir') bg-red-50 text-red-700 border-red-200
                                @else bg-yellow-50 text-yellow-700 border-yellow-200 @endif">
                                <i class="fas fa-check-circle mr-1"></i> {{ str_replace('_', ' ', ucfirst($guest->status)) }}
                            </span>
                        </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>