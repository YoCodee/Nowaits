<x-dashboard-layout>
    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto" x-data="{ showTrackModal: false, selectedTrx: null }">

        <!-- Welcome banner -->
        <div class="relative bg-white p-4 sm:p-6 rounded-2xl overflow-hidden mb-8 shadow-sm border border-gray-100">
            <div class="relative z-10">
                <h1 class="text-2xl md:text-3xl font-bold text-gray-800 mb-1">Riwayat Pesanan</h1>
                <p class="text-gray-500">Pantau status pesanan buah Anda di sini.</p>
            </div>
             <div class="absolute right-0 top-0 h-full w-1/3 bg-gradient-to-l from-[#bef264]/20 to-transparent pointer-events-none"></div>
        </div>

        @if(session('success'))
            <div class="mb-4 bg-[#bef264]/20 border border-[#bef264] text-[#022c22] px-4 py-3 rounded-xl relative" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif

        <div class="bg-white border border-gray-100 rounded-2xl shadow-sm overflow-hidden">
            @if($transaksis->count() > 0)
                <div class="overflow-x-auto">
                    <table class="table-auto w-full text-left">
                        <thead class="bg-gray-50 text-gray-500 font-bold uppercase text-xs">
                            <tr>
                                <th class="px-6 py-4">Produk</th>
                                <th class="px-6 py-4">Penjual</th>
                                <th class="px-6 py-4 text-center">Jumlah</th>
                                <th class="px-6 py-4">Total Bayar</th>
                                <th class="px-6 py-4 text-center">Status</th>
                                <th class="px-6 py-4 text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 text-sm">
                            @foreach($transaksis as $trx)
                                <tr class="hover:bg-gray-50/50 transition-colors">
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-3">
                                            @if($trx->postingan && $trx->postingan->buah->gambar)
                                                <img src="{{ asset('storage/' . $trx->postingan->buah->gambar) }}" class="w-10 h-10 rounded-lg object-cover bg-gray-100">
                                            @else
                                                <div class="w-10 h-10 rounded-lg bg-gray-100 flex items-center justify-center text-gray-400">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><circle cx="8.5" cy="8.5" r="1.5"></circle><polyline points="21 15 16 10 5 21"></polyline></svg>
                                                </div>
                                            @endif
                                            <div>
                                                <div class="font-bold text-gray-900">{{ $trx->postingan->judul_posting ?? 'Produk Dihapus' }}</div>
                                                <div class="text-xs text-gray-500">{{ $trx->created_at->format('d M Y, H:i') }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-gray-600">
                                        {{ $trx->penjual->name ?? 'Unknown' }}
                                    </td>
                                    <td class="px-6 py-4 text-center font-medium">
                                        {{ $trx->jumlah_kg }} Kg
                                    </td>
                                    <td class="px-6 py-4 font-bold text-[#022c22]">
                                        Rp {{ number_format($trx->total_bayar, 0, ',', '.') }}
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        @php
                                            $statusColors = [
                                                'menunggu_pembayaran' => 'bg-yellow-100 text-yellow-700',
                                                'menunggu_konfirmasi' => 'bg-blue-100 text-blue-700',
                                                'diproses' => 'bg-indigo-100 text-indigo-700',
                                                'dikirim' => 'bg-purple-100 text-purple-700',
                                                'selesai' => 'bg-[#bef264]/40 text-[#022c22]',
                                                'dibatalkan' => 'bg-red-100 text-red-700',
                                            ];
                                            $statusLabel = ucwords(str_replace('_', ' ', $trx->status));
                                        @endphp
                                        <span class="px-3 py-1 rounded-full text-xs font-bold {{ $statusColors[$trx->status] ?? 'bg-gray-100 text-gray-600' }}">
                                            {{ $statusLabel }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-right">
                                        @if($trx->status === 'menunggu_pembayaran')
                                            <a href="{{ route('transaksi.payment', $trx->id_transaksi) }}" class="inline-block bg-[#022c22] text-[#bef264] px-4 py-2 rounded-lg text-xs font-bold hover:bg-[#033a2d] transition-colors">
                                                Bayar Sekarang
                                            </a>
                                        @elseif($trx->status === 'dikirim' || $trx->status === 'selesai')
                                            @if($trx->pengiriman)
                                                <button @click="showTrackModal = true; selectedTrx = {{ json_encode($trx->pengiriman) }}" class="inline-block bg-purple-50 text-purple-700 border border-purple-200 px-3 py-2 rounded-lg text-xs font-bold hover:bg-purple-100 transition-colors">
                                                    Lacak Paket
                                                </button>
                                            @endif
                                            @if($trx->status === 'dikirim')
                                                <form action="{{ route('transaksi.confirm', $trx->id_transaksi) }}" method="POST" class="inline-block ml-2">
                                                    @csrf
                                                    <input type="hidden" name="action" value="complete">
                                                    <button type="submit" class="bg-[#bef264] text-[#022c22] px-3 py-2 rounded-lg text-xs font-bold hover:bg-[#a3e635]">
                                                        Diterima
                                                    </button>
                                                </form>
                                            @endif
                                        @else
                                            <button disabled class="text-gray-400 font-bold text-xs border border-gray-200 px-3 py-2 rounded-lg cursor-not-allowed">
                                                Detail
                                            </button>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="p-12 text-center flex flex-col items-center justify-center">
                    <div class="w-16 h-16 bg-gray-50 rounded-full flex items-center justify-center mb-4 text-gray-300">
                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path><line x1="3" y1="6" x2="21" y2="6"></line><path d="M16 10a4 4 0 0 1-8 0"></path></svg>
                    </div>
                    <h3 class="text-gray-900 font-bold text-lg mb-1">Belum Ada Pesanan</h3>
                    <p class="text-gray-500 text-sm mb-6 max-w-md mx-auto">Anda belum pernah melakukan pembelian apapun. Mulai cari stok buah segar dari petani sekarang!</p>
                    <a href="{{ route('marketplace.index') }}" class="bg-[#bef264] text-[#022c22] px-6 py-3 rounded-xl font-bold hover:bg-[#a3e635] transition-colors shadow-lg hover:shadow-xl active:scale-95">
                        Cari Stok Buah
                    </a>
                </div>
            @endif
        </div>

        <!-- Tracking Modal -->
        <div x-show="showTrackModal" style="display: none;" class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
            <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                <div x-show="showTrackModal" class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true" @click="showTrackModal = false"></div>
                <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
                <div x-show="showTrackModal" class="inline-block relative z-50 align-bottom bg-white rounded-2xl text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-md w-full">

                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-lg leading-6 font-bold text-[#022c22]" id="modal-title">Lacak Paket</h3>
                            <button @click="showTrackModal = false" class="text-gray-400 hover:text-gray-500">
                                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                            </button>
                        </div>

                        <template x-if="selectedTrx">
                            <div class="space-y-4">
                                <div class="bg-gray-50 p-4 rounded-xl border border-gray-100">
                                    <span class="block text-xs uppercase text-gray-500 font-bold mb-1">Jasa Ekspedisi</span>
                                    <div class="text-lg font-bold text-[#022c22]" x-text="selectedTrx.ekspedisi"></div>
                                </div>

                                <div class="bg-gray-50 p-4 rounded-xl border border-gray-100">
                                    <span class="block text-xs uppercase text-gray-500 font-bold mb-1">Nomor Resi</span>
                                    <div class="text-lg font-bold text-[#022c22]" x-text="selectedTrx.no_resi || '-'"></div>
                                </div>

                                <template x-if="selectedTrx.foto_bukti_kirim">
                                    <div>
                                        <span class="block text-xs uppercase text-gray-500 font-bold mb-1">Bukti Foto</span>
                                        <img :src="'/storage/' + selectedTrx.foto_bukti_kirim" class="w-full rounded-xl border border-gray-200">
                                    </div>
                                </template>

                                <div x-show="selectedTrx.catatan">
                                    <span class="block text-xs uppercase text-gray-500 font-bold mb-1">Catatan Petani</span>
                                    <p class="text-gray-600 text-sm" x-text="selectedTrx.catatan"></p>
                                </div>

                                <div class="text-center text-xs text-gray-400 mt-4">
                                    Dikirim pada: <span x-text="new Date(selectedTrx.tgl_dikirim).toLocaleDateString('id-ID', {day: 'numeric', month: 'long', year: 'numeric', hour: '2-digit', minute:'2-digit'})"></span>
                                </div>
                            </div>
                        </template>
                    </div>
                </div>
            </div>
        </div>

    </div>
</x-dashboard-layout>
