<x-dashboard-layout>
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-[#022c22]">Laporan Pengiriman</h1>
        <p class="text-sm text-gray-500">Daftar semua pengiriman barang dari Petani ke Mitra.</p>
    </div>

    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm">
                <thead class="bg-gray-50 border-b border-gray-100">
                    <tr class="text-gray-500 font-bold uppercase text-xs">
                        <th class="px-6 py-4">ID Pengiriman</th>
                        <th class="px-6 py-4">Tanggal</th>
                        <th class="px-6 py-4">Ekspedisi / Resi</th>
                        <th class="px-6 py-4">Pengirim (Petani)</th>
                        <th class="px-6 py-4">Penerima (Mitra)</th>
                        <th class="px-6 py-4">Status</th>
                        <th class="px-6 py-4">Bukti</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse($pengirimans as $ship)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4 font-bold text-[#022c22]">
                                #{{ substr($ship->id_pengiriman, 0, 8) }}
                            </td>
                            <td class="px-6 py-4 text-gray-600">
                                {{ $ship->created_at->format('d M Y H:i') }}
                            </td>
                            <td class="px-6 py-4">
                                <div class="font-bold text-gray-800">{{ $ship->ekspedisi }}</div>
                                <div class="text-xs text-gray-400 font-mono">{{ $ship->no_resi }}</div>
                            </td>
                            <td class="px-6 py-4 text-gray-600">
                                {{ $ship->transaksi->penjual->name ?? '-' }}
                            </td>
                            <td class="px-6 py-4 text-gray-600">
                                <div class="font-bold">{{ $ship->transaksi->pembeli->name ?? '-' }}</div>
                                <div class="text-xs text-gray-400 mt-1 truncate max-w-[200px]" title="{{ $ship->transaksi->alamat_pengiriman_snapshot['alamat_lengkap'] ?? '' }}">
                                    {{ $ship->transaksi->alamat_pengiriman_snapshot['alamat_lengkap'] ?? '-' }}
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                @php
                                    $statusClasses = [
                                        'dikirim' => 'bg-blue-100 text-blue-700',
                                        'sampai' => 'bg-green-100 text-green-700',
                                        'pending' => 'bg-yellow-100 text-yellow-700',
                                    ];
                                    $class = $statusClasses[$ship->status] ?? 'bg-gray-100 text-gray-600';
                                @endphp
                                <span class="px-2 py-1 rounded-md text-xs font-bold {{ $class }}">
                                    {{ ucfirst($ship->status) }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                @if($ship->foto_bukti_kirim)
                                    <a href="{{ asset('storage/' . $ship->foto_bukti_kirim) }}" target="_blank" class="text-blue-600 hover:text-blue-800 underline text-xs font-bold">
                                        Lihat Foto
                                    </a>
                                @else
                                    <span class="text-gray-300">-</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-8 text-center text-gray-400">
                                Belum ada data pengiriman.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-6">
        {{ $pengirimans->links() }}
    </div>
</x-dashboard-layout>
