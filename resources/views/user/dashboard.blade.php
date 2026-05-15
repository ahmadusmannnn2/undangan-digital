<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard Pelanggan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            
            <!-- Notifikasi Sukses -->
            @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative">
                {{ session('success') }}
            </div>
            @endif

            <!-- Bagian 1: Pesanan Saya & Sebar Link Tamu -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-bold mb-4">Undangan Saya & Sebar Link Tamu</h3>
                @if($orders->isEmpty())
                    <p class="text-gray-500">Anda belum memiliki pesanan undangan.</p>
                @else
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        @foreach($orders as $order)
                        <div class="border rounded-xl p-5 shadow-sm bg-gray-50 relative overflow-hidden">
                            @if($order->payment_status == 'success')
                                <div class="absolute top-0 right-0 bg-green-500 text-white text-xs font-bold px-3 py-1 rounded-bl-lg">Aktif</div>
                            @else
                                <div class="absolute top-0 right-0 bg-yellow-500 text-white text-xs font-bold px-3 py-1 rounded-bl-lg">Pending</div>
                            @endif
                            
                            <h4 class="text-xl font-bold text-indigo-900 mb-1">{{ $order->groom_name }} & {{ $order->bride_name }}</h4>
                            <p class="text-sm text-gray-500 mb-4">Tema: {{ $order->template->name }}</p>
                            
                            @if($order->payment_status == 'success')
                            <div class="bg-white p-4 rounded-lg border border-gray-200 mb-4">
                                <label class="block text-xs font-bold text-gray-700 mb-2">Buat Link Khusus Tamu:</label>
                                <div class="flex gap-2">
                                    <input type="text" id="guestName_{{ $order->id }}" placeholder="Nama Tamu (Cth: Budi & Partner)" class="w-full text-sm border-gray-300 rounded-md">
                                    <button onclick="generateLink('{{ url('/' . $order->domain_url) }}', {{ $order->id }})" class="bg-green-600 hover:bg-green-700 text-white px-3 py-2 rounded-md text-sm font-bold whitespace-nowrap">Copy Link</button>
                                </div>
                            </div>
                            <a href="{{ route('user.guests.index', $order->id) }}" class="block w-full text-center bg-indigo-100 hover:bg-indigo-200 text-indigo-800 font-bold py-2 rounded-md transition text-sm">Lihat Buku Tamu ({{ $order->guests->count() }})</a>
                            @else
                            <p class="text-sm text-red-500 italic mt-4">Tunggu admin mengaktifkan pesanan Anda untuk menyebar link.</p>
                            @endif
                        </div>
                        @endforeach
                    </div>
                @endif
            </div>

            <!-- Bagian 2: Katalog Template -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-bold mb-4">Buat Undangan Baru</h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    @foreach($templates as $template)
                    <div class="border rounded-lg p-4 shadow hover:shadow-lg transition">
                        @if($template->preview_image)
                            <img src="{{ asset('storage/' . $template->preview_image) }}" alt="Preview" class="w-full h-40 object-cover rounded mb-4">
                        @else
                            <div class="w-full h-40 bg-gray-200 flex items-center justify-center rounded mb-4 text-gray-500">No Image</div>
                        @endif
                        <h4 class="font-bold text-xl">{{ $template->name }}</h4>
                        <p class="text-gray-600 mb-4">Rp {{ number_format($template->price, 0, ',', '.') }}</p>
                        <a href="{{ route('user.order.create', $template->id) }}" class="block w-full text-center bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded">
                            Pesan Tema Ini
                        </a>
                    </div>
                    @endforeach
                </div>
            </div>

        </div>
    </div>

    <!-- JS untuk Generate Link Tamu -->
    <script>
        function generateLink(baseUrl, orderId) {
            let guestName = document.getElementById('guestName_' + orderId).value;
            if(!guestName) {
                alert('Silakan masukkan nama tamu terlebih dahulu!');
                return;
            }
            // Membuat link dengan parameter ?to=Nama+Tamu
            let finalLink = baseUrl + '?to=' + encodeURIComponent(guestName);
            
            // Copy ke clipboard
            navigator.clipboard.writeText(finalLink).then(() => {
                alert('Link berhasil di-copy:\n' + finalLink);
            });
        }
    </script>
</x-app-layout>