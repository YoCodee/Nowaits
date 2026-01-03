<x-dashboard-layout>
    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">

        <!-- Welcome banner -->
        <div class="relative bg-white p-4 sm:p-6 rounded-2xl overflow-hidden mb-8 shadow-sm border border-gray-100">
            <div class="relative z-10">
                <h1 class="text-2xl md:text-3xl font-bold text-gray-800 mb-1">Laporan Transaksi</h1>
                <p class="text-gray-500">Rekapitulasi semua transaksi yang terjadi dalam sistem.</p>
            </div>
             <div class="absolute right-0 top-0 h-full w-1/3 bg-gradient-to-l from-[#bef264]/20 to-transparent pointer-events-none"></div>
        </div>

        <div class="bg-white border border-gray-100 rounded-2xl shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="table-auto w-full text-left">
                    <thead class="bg-gray-50 text-gray-500 font-bold uppercase text-xs">
                        <tr>
                            <th class="px-6 py-4">ID Transaksi</th>
                            <th class="px-6 py-4">Tanggal</th>
                            <th class="px-6 py-4">Produk</th>
                            <th class="px-6 py-4">Penjual</th>
                            <th class="px-6 py-4">Pembeli</th>
                            <th class="px-6 py-4 text-center">Qty</th>
                            <th class="px-6 py-4 text-right">Total</th>
                            <th class="px-6 py-4 text-center">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 text-sm">
                        @foreach($transaksis as $trx)
                            <tr class="hover:bg-gray-50/50 transition-colors">
                                <td class="px-6 py-4 font-mono text-xs text-gray-500">#{{ substr($trx->id_transaksi, 0, 8) }}</td>
                                <td class="px-6 py-4 text-gray-600 space-y-1">
                                    <div>{{ $trx->created_at->format('d M Y') }}</div>
                                    <div class="text-xs text-gray-400">{{ $trx->created_at->format('H:i') }}</div>
                                </td>
                                <td class="px-6 py-4 font-bold text-gray-900">
                                    {{ $trx->postingan->buah->nama_buah ?? 'Deleted Item' }}
                                </td>
                                <td class="px-6 py-4 text-gray-600">{{ $trx->penjual->name ?? '-' }}</td>
                                <td class="px-6 py-4 text-gray-600">{{ $trx->pembeli->name ?? '-' }}</td>
                                <td class="px-6 py-4 text-center font-medium">{{ $trx->jumlah_kg }} Kg</td>
                                <td class="px-6 py-4 text-right font-bold text-[#022c22]">
                                    Rp {{ number_format($trx->total_bayar, 0, ',', '.') }}
                                </td>
                                <td class="px-6 py-4 text-center">
                                    @php
                                        $statusClass = match($trx->status) {
                                            'selesai' => 'bg-green-100 text-green-700',
                                            'dibatalkan' => 'bg-red-100 text-red-700',
                                            'dikirim' => 'bg-blue-100 text-blue-700',
                                            'diproses' => 'bg-indigo-100 text-indigo-700',
                                            default => 'bg-gray-100 text-gray-600',
                                        };
                                    @endphp
                                    <span class="px-2 py-1 rounded text-xs font-bold {{ $statusClass }}">
                                        {{ ucfirst($trx->status) }}
                                    </span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="px-6 py-4 border-t border-gray-100">
                {{ $transaksis->links() }}
            </div>
        </div>

    </div>
</x-dashboard-layout>
