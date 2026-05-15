<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Buku Tamu: {{ $order->groom_name }} & {{ $order->bride_name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <a href="{{ route('user.dashboard') }}" class="text-indigo-600 hover:underline mb-4 inline-block">&larr; Kembali ke Dashboard</a>
            
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-bold mb-4">Daftar Kehadiran & Ucapan</h3>
                
                @if($guests->isEmpty())
                    <p class="text-gray-500">Belum ada tamu yang mengisi buku tamu.</p>
                @else
                    <div class="space-y-4">
                        @foreach($guests as $guest)
                        <div class="border border-gray-200 rounded-lg p-4 bg-gray-50">
                            <div class="flex justify-between items-start mb-2">
                                <h4 class="font-bold text-md text-gray-800">{{ $guest->name }}</h4>
                                <span class="px-2 py-1 text-xs font-semibold rounded-full 
                                    @if($guest->status == 'hadir') bg-green-200 text-green-800 
                                    @elseif($guest->status == 'tidak_hadir') bg-red-200 text-red-800 
                                    @else bg-yellow-200 text-yellow-800 @endif">
                                    {{ str_replace('_', ' ', ucfirst($guest->status)) }}
                                </span>
                            </div>
                            <p class="text-gray-700 italic">"{{ $guest->message }}"</p>
                            <p class="text-xs text-gray-400 mt-2">{{ $guest->created_at->diffForHumans() }}</p>
                        </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>