<x-dashboard-layout>
    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">

        <!-- Welcome banner -->
        <div class="relative bg-white p-4 sm:p-6 rounded-2xl overflow-hidden mb-8 shadow-sm border border-gray-100">
            <div class="relative z-10">
                <h1 class="text-2xl md:text-3xl font-bold text-gray-800 mb-1">Laporan Pengiriman</h1>
                <p class="text-gray-500">Status pengiriman barang dari Petani ke Mitra.</p>
            </div>
             <div class="absolute right-0 top-0 h-full w-1/3 bg-gradient-to-l from-[#bef264]/20 to-transparent pointer-events-none"></div>
        </div>

        <div class="bg-white border border-gray-100 rounded-2xl shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="table-auto w-full text-left">
                    <thead class="bg-gray-50 text-gray-500 font-bold uppercase text-xs">
                        <tr>
                            <th class="px-6 py-4">ID Kirim</th>
                            <th class="px-6 py-4">Ekspedisi / Resi</th>
                            <th class="px-6 py-4">Pengirim (Petani)</th>
                            <th class="px-6 py-4">Penerima (Mitra)</th>
                            <th class="px-6 py-4">Tgl Kirim</th>
                            <th class="px-6 py-4 text-center">Status</th>
                            <th class="px-6 py-4 text-center">Bukti</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 text-sm">
                        @foreach($pengirimans as $ship)
                            <tr class="hover:bg-gray-50/50 transition-colors">
                                <td class="px-6 py-4 font-mono text-xs text-gray-500">
                                    #{{ substr($ship->id_pengiriman, 0, 8) }}
                                    <div class="text-[10px] text-gray-400 mt-1">Ref TRX: {{ substr($ship->id_transaksi, 0, 8) }}</div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="font-bold text-gray-900">{{ $ship->ekspedisi }}</div>
                                    <div class="text-xs text-gray-500">{{ $ship->no_resi ?? '-' }}</div>
                                </td>
                                <td class="px-6 py-4 text-gray-600">
                                    <div class="font-medium">{{ $ship->transaksi->penjual->name ?? '-' }}</div>
                                    <div class="text-xs text-gray-400">{{ $ship->transaksi->postingan->user->alamatPengguna->kota ?? '' }}</div>
                                </td>
                                <td class="px-6 py-4 text-gray-600">
                                    <div class="font-medium">{{ $ship->transaksi->pembeli->name ?? '-' }}</div>
                                </td>
                                <td class="px-6 py-4 text-gray-600">
                                    {{ \Carbon\Carbon::parse($ship->tgl_dikirim)->format('d M Y') }}
                                </td>
                                <td class="px-6 py-4 text-center">
                                    @php
                                        $statusClass = match($ship->status) {
                                            'sampai' => 'bg-green-100 text-green-700',
                                            'dikirim' => 'bg-blue-100 text-blue-700',
                                            'diproses' => 'bg-yellow-100 text-yellow-700',
                                            default => 'bg-gray-100 text-gray-600',
                                        };
                                    @endphp
                                    <span class="px-2 py-1 rounded text-xs font-bold {{ $statusClass }}">
                                        {{ ucfirst($ship->status) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-center">
                                    @if($ship->foto_bukti_kirim)
                                        <a href="{{ asset('storage/' . $ship->foto_bukti_kirim) }}" target="_blank" class="text-blue-600 hover:text-blue-800 underline text-xs font-bold">
                                            Lihat
                                        </a>
                                    @else
                                        <span class="text-gray-400 text-xs">-</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="px-6 py-4 border-t border-gray-100">
                {{ $pengirimans->links() }}
            </div>
        </div>

    </div>
</x-dashboard-layout>
