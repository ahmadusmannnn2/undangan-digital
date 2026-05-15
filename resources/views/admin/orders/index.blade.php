<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Kelola Seluruh Pesanan Masuk</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if(session('success'))
            <div class="mb-6 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg relative shadow-sm">
                {{ session('success') }}
            </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-xl p-0 border border-gray-100">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Pelanggan</th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Mempelai & Tema</th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Link URL</th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-4 text-right text-xs font-bold text-gray-500 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($orders as $order)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-bold text-gray-900">{{ $order->user->name }}</div>
                                <div class="text-xs text-gray-500">{{ $order->user->email }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-semibold text-gray-900">{{ $order->groom_name }} & {{ $order->bride_name }}</div>
                                <div class="text-xs text-gray-500 mt-1">Tema: <span class="font-bold text-indigo-600">{{ $order->template->name }}</span></div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <a href="/{{ $order->domain_url }}" target="_blank" class="text-sm text-blue-500 hover:text-blue-700 hover:underline font-mono bg-blue-50 px-2 py-1 rounded">/{{ $order->domain_url }}</a>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-3 py-1 inline-flex text-xs leading-5 font-bold rounded-full {{ $order->payment_status == 'pending' ? 'bg-yellow-100 text-yellow-800' : 'bg-green-100 text-green-800' }}">
                                    {{ ucfirst($order->payment_status) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium flex justify-end gap-2">
                                @if($order->payment_status == 'pending')
                                <form action="{{ route('admin.orders.paid', $order) }}" method="POST" onsubmit="return confirm('Aktifkan undangan ini?')">
                                    @csrf @method('PATCH')
                                    <button type="submit" class="bg-green-600 hover:bg-green-700 text-white text-xs font-bold py-2 px-3 rounded shadow-sm">Terima Pembayaran</button>
                                </form>
                                @endif
                                
                                <form action="{{ route('admin.orders.destroy', $order) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus pesanan ini secara permanen?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="bg-red-100 hover:bg-red-200 text-red-700 text-xs font-bold py-2 px-3 rounded border border-red-200">Hapus</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>