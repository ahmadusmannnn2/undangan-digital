<x-app-layout>
    <x-slot name="header">
        <h2 class="font-extrabold text-2xl text-slate-800 leading-tight tracking-tight flex items-center gap-2">
            <i class="fas fa-inbox text-indigo-500"></i> Kelola Transaksi
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            
            @if(session('success'))
            <div class="glass-card border-l-4 border-green-500 text-green-800 p-4 rounded-xl flex items-center shadow-lg" data-aos="fade-down">
                <i class="fas fa-check-circle text-2xl mr-3 text-green-500"></i>
                <span class="font-semibold">{{ session('success') }}</span>
            </div>
            @endif

            <div class="glass-card rounded-3xl border border-white/60 overflow-hidden" data-aos="fade-up">
                <div class="overflow-x-auto">
                    <table class="min-w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-white/30 text-slate-500 text-xs uppercase tracking-widest border-b border-white/50">
                                <th class="px-6 py-5 font-bold">Pelanggan</th>
                                <th class="px-6 py-5 font-bold">Mempelai & Tema</th>
                                <th class="px-6 py-5 font-bold">Link URL</th>
                                <th class="px-6 py-5 font-bold">Status</th>
                                <th class="px-6 py-5 font-bold text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-white/40">
                            @forelse($orders as $order)
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
                                    <div class="text-xs text-indigo-600 mt-1 font-semibold">Tema: {{ $order->template->name }}</div>
                                </td>
                                <td class="px-6 py-5 whitespace-nowrap">
                                    <a href="/{{ $order->domain_url }}" target="_blank" class="text-sm font-mono bg-indigo-50 text-indigo-600 px-3 py-1.5 rounded-lg border border-indigo-100 hover:bg-indigo-600 hover:text-white transition flex items-center w-fit">
                                        <i class="fas fa-external-link-alt mr-2 text-xs"></i> /{{ $order->domain_url }}
                                    </a>
                                </td>
                                <td class="px-6 py-5 whitespace-nowrap">
                                    @if($order->payment_status == 'pending')
                                        <span class="px-3 py-1.5 text-xs font-bold rounded-full bg-amber-100/80 text-amber-700 border border-amber-200 flex items-center inline-flex w-fit shadow-sm"><i class="fas fa-spinner fa-spin mr-1.5 text-[10px]"></i> Menunggu</span>
                                    @else
                                        <span class="px-3 py-1.5 text-xs font-bold rounded-full bg-emerald-100/80 text-emerald-700 border border-emerald-200 flex items-center inline-flex w-fit shadow-sm"><i class="fas fa-check-circle mr-1.5"></i> Lunas</span>
                                    @endif
                                </td>
                                <td class="px-6 py-5 whitespace-nowrap text-right text-sm font-medium flex justify-end gap-2 items-center">
                                    @if($order->payment_status == 'pending')
                                    <form action="{{ route('admin.orders.paid', $order) }}" method="POST" onsubmit="return confirm('Aktifkan pesanan ini sekarang?')">
                                        @csrf @method('PATCH')
                                        <button type="submit" class="bg-gradient-to-r from-emerald-400 to-emerald-500 hover:from-emerald-500 hover:to-emerald-600 text-white text-xs font-bold py-2.5 px-4 rounded-lg shadow-md transition hover:-translate-y-0.5">
                                            Terima Pembayaran
                                        </button>
                                    </form>
                                    @endif
                                    
                                    <form action="{{ route('admin.orders.destroy', $order) }}" method="POST" onsubmit="return confirm('Hapus pesanan beserta fotonya secara permanen?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="bg-white hover:bg-red-50 text-red-500 border border-red-200 w-9 h-9 rounded-lg flex items-center justify-center transition shadow-sm hover:-translate-y-0.5" title="Hapus">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="px-6 py-12 text-center text-slate-400">
                                    <i class="fas fa-folder-open text-4xl mb-3 opacity-30 block"></i>
                                    <p class="font-semibold text-slate-500">Belum ada transaksi masuk.</p>
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