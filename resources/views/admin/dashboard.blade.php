<x-app-layout>
    <x-slot name="header">
        <h2 class="font-extrabold text-2xl text-slate-800 leading-tight tracking-tight flex items-center gap-2">
            <i class="fas fa-chart-pie text-indigo-500"></i> Analitik Bisnis
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            
            <!-- Welcome Banner Glassmorphism -->
            <div class="glass-card rounded-3xl p-8 relative overflow-hidden border border-white/60 flex items-center justify-between" data-aos="fade-down">
                <div class="absolute -right-20 -top-20 w-64 h-64 bg-gradient-to-br from-indigo-400 to-purple-400 rounded-full mix-blend-multiply filter blur-3xl opacity-30"></div>
                <div class="relative z-10">
                    <h3 class="text-3xl font-extrabold text-slate-800 mb-2">Halo, {{ Auth::user()->name }}! 👋</h3>
                    <p class="text-slate-500 text-lg">Inilah performa platform UndanganPro Anda hari ini.</p>
                </div>
            </div>

            <!-- Kartu Statistik -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6" data-aos="fade-up" data-aos-delay="100">
                
                <div class="glass-card p-6 rounded-2xl border border-white/60 hover:-translate-y-1 transition duration-300">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-1">Total Pendapatan</p>
                            <p class="text-3xl font-black text-slate-800">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</p>
                        </div>
                        <div class="w-12 h-12 bg-gradient-to-tr from-emerald-400 to-teal-500 rounded-xl flex items-center justify-center text-white shadow-lg shadow-emerald-500/30">
                            <i class="fas fa-wallet text-xl"></i>
                        </div>
                    </div>
                </div>

                <div class="glass-card p-6 rounded-2xl border border-white/60 hover:-translate-y-1 transition duration-300">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-1">Total Pesanan</p>
                            <p class="text-3xl font-black text-slate-800">{{ $totalPesanan }}</p>
                        </div>
                        <div class="w-12 h-12 bg-gradient-to-tr from-blue-400 to-indigo-500 rounded-xl flex items-center justify-center text-white shadow-lg shadow-blue-500/30">
                            <i class="fas fa-shopping-bag text-xl"></i>
                        </div>
                    </div>
                </div>

                <div class="glass-card p-6 rounded-2xl border border-white/60 hover:-translate-y-1 transition duration-300">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-1">Menunggu ACC</p>
                            <p class="text-3xl font-black text-slate-800">{{ $pesananPending }}</p>
                        </div>
                        <div class="w-12 h-12 bg-gradient-to-tr from-amber-400 to-orange-500 rounded-xl flex items-center justify-center text-white shadow-lg shadow-amber-500/30">
                            <i class="fas fa-hourglass-half text-xl"></i>
                        </div>
                    </div>
                </div>

                <div class="glass-card p-6 rounded-2xl border border-white/60 hover:-translate-y-1 transition duration-300">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-1">Pelanggan</p>
                            <p class="text-3xl font-black text-slate-800">{{ $totalPengguna }}</p>
                        </div>
                        <div class="w-12 h-12 bg-gradient-to-tr from-purple-400 to-pink-500 rounded-xl flex items-center justify-center text-white shadow-lg shadow-purple-500/30">
                            <i class="fas fa-users text-xl"></i>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Tabel Pesanan Terbaru -->
            <div class="glass-card rounded-3xl border border-white/60 overflow-hidden" data-aos="fade-up" data-aos-delay="200">
                <div class="p-6 border-b border-white/40 flex justify-between items-center bg-white/30 backdrop-blur-sm">
                    <h3 class="text-lg font-extrabold text-slate-800"><i class="fas fa-history mr-2 text-indigo-500"></i>Aktivitas Terbaru</h3>
                    <a href="{{ route('admin.orders.index') }}" class="text-sm bg-white/50 border border-white hover:bg-white text-indigo-600 font-bold px-4 py-2 rounded-lg transition shadow-sm">Lihat Semua Data</a>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-white/20 text-slate-500 text-xs uppercase tracking-widest border-b border-white/40">
                                <th class="px-6 py-4 font-bold">Pelanggan</th>
                                <th class="px-6 py-4 font-bold">Proyek & Tautan</th>
                                <th class="px-6 py-4 font-bold">Tema</th>
                                <th class="px-6 py-4 font-bold">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-white/40">
                            @forelse($recentOrders as $order)
                            <tr class="hover:bg-white/40 transition">
                                <td class="px-6 py-5 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="w-10 h-10 rounded-full bg-gradient-to-br from-indigo-100 to-purple-100 border border-white flex items-center justify-center text-indigo-700 font-bold mr-3 shadow-sm">
                                            {{ substr($order->user->name, 0, 1) }}
                                        </div>
                                        <div>
                                            <div class="text-sm font-bold text-slate-800">{{ $order->user->name }}</div>
                                            <div class="text-xs text-slate-500">{{ $order->user->email }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-5 whitespace-nowrap">
                                    <div class="text-sm font-extrabold text-slate-800">{{ $order->groom_name }} & {{ $order->bride_name }}</div>
                                    <div class="text-xs text-indigo-600 font-mono mt-1 px-2 py-1 bg-indigo-50/50 border border-indigo-100 rounded inline-block">/{{ $order->domain_url }}</div>
                                </td>
                                <td class="px-6 py-5 whitespace-nowrap">
                                    <span class="text-sm font-semibold text-slate-600 bg-slate-100/50 px-3 py-1 rounded-lg border border-white">{{ $order->template->name }}</span>
                                </td>
                                <td class="px-6 py-5 whitespace-nowrap">
                                    @if($order->payment_status == 'success')
                                        <span class="px-3 py-1 text-xs font-bold rounded-full bg-emerald-100/80 text-emerald-700 border border-emerald-200 flex items-center inline-flex w-fit"><i class="fas fa-check-circle mr-1.5"></i> Lunas</span>
                                    @else
                                        <span class="px-3 py-1 text-xs font-bold rounded-full bg-amber-100/80 text-amber-700 border border-amber-200 flex items-center inline-flex w-fit"><i class="fas fa-spinner fa-spin mr-1.5"></i> Pending</span>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="px-6 py-12 text-center text-slate-400">
                                    <i class="fas fa-inbox text-4xl mb-3 opacity-20 block"></i>
                                    <p class="font-semibold">Belum ada transaksi masuk.</p>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>