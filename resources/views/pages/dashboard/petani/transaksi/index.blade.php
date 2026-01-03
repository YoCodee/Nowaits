<x-dashboard-layout>
    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto" x-data="{ showShipModal: false, selectedTrxId: null }">

        <!-- Welcome banner -->
        <div class="relative bg-white p-4 sm:p-6 rounded-2xl overflow-hidden mb-8 shadow-sm border border-gray-100">
            <div class="relative z-10">
                <h1 class="text-2xl md:text-3xl font-bold text-gray-800 mb-1">Pesanan Masuk</h1>
                <p class="text-gray-500">Kelola pesanan dari Mitra yang masuk.</p>
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
                                <th class="px-6 py-4">Pembeli</th>
                                <th class="px-6 py-4 text-center">Qty</th>
                                <th class="px-6 py-4">Total</th>
                                <th class="px-6 py-4 text-center">Status</th>
                                <th class="px-6 py-4 text-center">Bukti Bayar</th>
                                <th class="px-6 py-4 text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 text-sm">
                            @foreach($transaksis as $trx)
                                <tr class="hover:bg-gray-50/50 transition-colors">
                                    <td class="px-6 py-4">
                                        <div class="font-bold text-gray-900">{{ $trx->postingan->judul_posting }}</div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="font-bold text-gray-900">{{ $trx->pembeli->name }}</div>
                                        <div class="text-xs text-gray-500" title="{{ $trx->alamat_pengiriman_snapshot['alamat_lengkap'] ?? $trx->pembeli->alamatPengguna->alamat_lengkap ?? '' }}">
                                            {{ Str::limit(($trx->alamat_pengiriman_snapshot['kota'] ?? $trx->pembeli->alamatPengguna->kota ?? '') . ' ' . ($trx->alamat_pengiriman_snapshot['alamat_lengkap'] ?? $trx->pembeli->alamatPengguna->alamat_lengkap ?? 'Lokasi tidak ada'), 30) }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        {{ $trx->jumlah_kg }} Kg
                                    </td>
                                    <td class="px-6 py-4 font-bold text-[#022c22]">
                                        Rp {{ number_format($trx->total_bayar, 0, ',', '.') }}
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        <span class="px-3 py-1 rounded-full text-xs font-bold
                                            @if($trx->status == 'selesai') bg-green-100 text-green-700
                                            @elseif($trx->status == 'dibatalkan') bg-red-100 text-red-700
                                            @elseif($trx->status == 'dikirim') bg-blue-100 text-blue-700
                                            @else bg-gray-100 text-gray-600 @endif
                                            ">
                                            {{ ucwords(str_replace('_', ' ', $trx->status)) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        @if($trx->bukti_bayar)
                                            <a href="{{ asset('storage/' . $trx->bukti_bayar) }}" target="_blank" class="text-blue-600 underline text-xs font-bold hover:text-blue-800">
                                                Lihat Bukti
                                            </a>
                                        @else
                                            <span class="text-gray-400 text-xs">-</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 flex justify-end gap-2">
                                        @if($trx->status === 'menunggu_konfirmasi')
                                            <!-- Action: Accept or Reject -->
                                            <form action="{{ route('transaksi.confirm', $trx->id_transaksi) }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="action" value="accept">
                                                <button type="submit" class="bg-[#bef264] text-[#022c22] px-3 py-2 rounded-lg text-xs font-bold hover:bg-[#a3e635]">Terima</button>
                                            </form>
                                            <form action="{{ route('transaksi.confirm', $trx->id_transaksi) }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="action" value="reject">
                                                <button type="submit" class="bg-red-50 text-red-600 px-3 py-2 rounded-lg text-xs font-bold hover:bg-red-100">Tolak</button>
                                            </form>
                                        @elseif($trx->status === 'diproses')
                                             <button @click="showShipModal = true; selectedTrxId = '{{ $trx->id_transaksi }}'" class="bg-blue-50 text-blue-600 px-3 py-2 rounded-lg text-xs font-bold hover:bg-blue-100">
                                                Kirim Barang
                                             </button>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="p-12 text-center text-gray-500">
                    Belum ada pesanan masuk.
                </div>
            @endif
        </div>

        <!-- Shipping Modal -->
        <div x-show="showShipModal" style="display: none;" class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
            <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">

                <div x-show="showShipModal"
                     x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                     x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                     class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true" @click="showShipModal = false"></div>

                <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

                <div x-show="showShipModal"
                     x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                     x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                     class="inline-block relative z-50 align-bottom bg-white rounded-2xl text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg w-full">

                    <form :action="'{{ url('/transaksi') }}/' + selectedTrxId + '/ship'" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                            <h3 class="text-lg leading-6 font-bold text-gray-900 mb-4" id="modal-title">Input Data Pengiriman</h3>

                            <div class="space-y-4">
                                <div>
                                    <label class="block text-sm font-bold text-gray-700 mb-1">Jasa Ekspedisi / Kurir</label>
                                    <select name="ekspedisi" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#022c22]">
                                        <option value="JNE">JNE</option>
                                        <option value="J&T">J&T</option>
                                        <option value="SiCepat">SiCepat</option>
                                        <option value="POS Indonesia">POS Indonesia</option>
                                        <option value="GoSend/Grab">GoSend/Grab (Instan)</option>
                                        <option value="Kurir Pribadi">Kurir Pribadi (Antar Sendiri)</option>
                                        <option value="Lainnya">Lainnya</option>
                                    </select>
                                </div>

                                <div>
                                    <label class="block text-sm font-bold text-gray-700 mb-1">Nomor Resi (Opsional)</label>
                                    <input type="text" name="no_resi" placeholder="Contoh: JP1234567890" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#022c22]">
                                    <p class="text-xs text-gray-400 mt-1">Kosongkan jika menggunakan kurir pribadi.</p>
                                </div>

                                <div>
                                    <label class="block text-sm font-bold text-gray-700 mb-1">Foto Bukti Kirim / Resi (Opsional)</label>
                                    <input type="file" name="foto_bukti_kirim" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-semibold file:bg-[#bef264] file:text-[#022c22] hover:file:bg-[#a3e635]">
                                </div>

                                <div>
                                    <label class="block text-sm font-bold text-gray-700 mb-1">Catatan Tambahan</label>
                                    <textarea name="catatan" rows="2" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#022c22]" placeholder="Pesan untuk pembeli..."></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                            <button type="submit" class="w-full inline-flex justify-center rounded-xl border border-transparent shadow-sm px-4 py-2 bg-[#022c22] text-base font-medium text-white hover:bg-[#033a2d] focus:outline-none sm:ml-3 sm:w-auto sm:text-sm">
                                Konfirmasi Kirim
                            </button>
                            <button type="button" @click="showShipModal = false" class="mt-3 w-full inline-flex justify-center rounded-xl border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                                Batal
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
</x-dashboard-layout>
