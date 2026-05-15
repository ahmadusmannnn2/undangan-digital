<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Admin Dashboard (Statistik Bisnis)') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            <!-- Welcome Banner -->
            <div class="bg-indigo-600 rounded-xl shadow-lg p-6 text-white flex justify-between items-center">
                <div>
                    <h3 class="text-2xl font-bold mb-1">Selamat Datang, {{ Auth::user()->name }}! 🚀</h3>
                    <p class="text-indigo-200">Berikut adalah ringkasan performa bisnis undangan digital Anda hari ini.</p>
                </div>
                <div class="hidden md:block">
                    <i class="fas fa-chart-line text-6xl text-indigo-400 opacity-50"></i>
                </div>
            </div>

            <!-- Kartu Statistik (4 Kolom) -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                
                <!-- Card Pendapatan -->
                <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 flex items-center">
                    <div class="p-4 bg-green-100 rounded-lg mr-4">
                        <i class="fas fa-money-bill-wave text-2xl text-green-600"></i>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500 font-semibold uppercase tracking-wider">Total Pendapatan</p>
                        <p class="text-2xl font-bold text-gray-900">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</p>
                    </div>
                </div>

                <!-- Card Total Pesanan -->
                <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 flex items-center">
                    <div class="p-4 bg-blue-100 rounded-lg mr-4">
                        <i class="fas fa-shopping-cart text-2xl text-blue-600"></i>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500 font-semibold uppercase tracking-wider">Total Pesanan</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $totalPesanan }}</p>
                    </div>
                </div>

                <!-- Card Pesanan Pending -->
                <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 flex items-center">
                    <div class="p-4 bg-yellow-100 rounded-lg mr-4">
                        <i class="fas fa-clock text-2xl text-yellow-600"></i>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500 font-semibold uppercase tracking-wider">Menunggu ACC</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $pesananPending }}</p>
                    </div>
                </div>

                <!-- Card Pengguna Aktif -->
                <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 flex items-center">
                    <div class="p-4 bg-purple-100 rounded-lg mr-4">
                        <i class="fas fa-users text-2xl text-purple-600"></i>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500 font-semibold uppercase tracking-wider">Total Pelanggan</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $totalPengguna }}</p>
                    </div>
                </div>

            </div>

            <!-- Tabel Pesanan Terbaru -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-xl border border-gray-100">
                <div class="p-6 border-b border-gray-100 flex justify-between items-center bg-gray-50">
                    <h3 class="text-lg font-bold text-gray-800">5 Pesanan Masuk Terakhir</h3>
                    <a href="{{ route('admin.orders.index') }}" class="text-sm text-indigo-600 font-bold hover:underline">Lihat Semua &rarr;</a>
                </div>
                <div class="p-0 overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-white">
                            <tr>
                                <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase">Pelanggan</th>
                                <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase">Mempelai</th>
                                <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase">Tema</th>
                                <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 bg-white">
                            @forelse($recentOrders as $order)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-bold text-gray-900">{{ $order->user->name }}</div>
                                    <div class="text-sm text-gray-500">{{ $order->user->email }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-semibold text-gray-900">{{ $order->groom_name }} & {{ $order->bride_name }}</div>
                                    <div class="text-xs text-indigo-500 font-mono">{{ $order->domain_url }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $order->template->name }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full {{ $order->payment_status == 'pending' ? 'bg-yellow-100 text-yellow-800' : 'bg-green-100 text-green-800' }}">
                                        {{ ucfirst($order->payment_status) }}
                                    </span>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="px-6 py-8 text-center text-gray-500">Belum ada pesanan yang masuk.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>