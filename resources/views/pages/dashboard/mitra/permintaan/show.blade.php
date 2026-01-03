<x-dashboard-layout>
    <div class="mb-4">
        <a href="{{ route('permintaan-mitra.index') }}" class="flex items-center gap-2 text-gray-500 hover:text-[#022c22] transition-colors mb-4">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>
            Kembali
        </a>
        <div class="flex items-center justify-between">
            <h2 class="text-2xl font-bold text-[#022c22]">Permintaan: {{ $permintaan->nama_buah_dicari }}</h2>
            <span class="px-3 py-1 rounded-full text-sm font-bold
                @if($permintaan->status_tawaran == 'aktif') bg-green-100 text-green-700
                @elseif($permintaan->status_tawaran == 'terpenuhi') bg-blue-100 text-blue-700
                @else bg-gray-100 text-gray-700 @endif">
                {{ ucfirst($permintaan->status_tawaran) }}
            </span>
        </div>
    </div>

    <!-- Request Details -->
    <div class="bg-white rounded-2xl border border-gray-100 p-6 shadow-sm mb-8">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
            <div>
                <span class="block text-gray-400 text-xs mb-1">Jumlah Dicari</span>
                <span class="font-bold text-gray-800 text-lg">{{ $permintaan->jumlah_dicari_kg }} Kg</span>
            </div>
            <div>
                <span class="block text-gray-400 text-xs mb-1">Budget /kg</span>
                <span class="font-bold text-gray-800 text-lg">Rp {{ number_format($permintaan->harga_ajuan_per_kg, 0, ',', '.') }}</span>
            </div>
            <div>
                <span class="block text-gray-400 text-xs mb-1">Min. Kriteria (0-1)</span>
                <div class="flex gap-2 text-xs font-bold text-gray-800">
                    <span title="Kulit" class="bg-gray-100 px-2 py-1 rounded">K: {{ $permintaan->min_skor_kulit }}</span>
                    <span title="Bentuk" class="bg-gray-100 px-2 py-1 rounded">B: {{ $permintaan->min_skor_bentuk }}</span>
                    <span title="Tekstur" class="bg-gray-100 px-2 py-1 rounded">T: {{ $permintaan->min_skor_tekstur }}</span>
                </div>
            </div>
            <div>
                 <span class="block text-gray-400 text-xs mb-1">Dibuat Pada</span>
                <span class="font-bold text-gray-800 text-lg">{{ $permintaan->created_at->format('d M Y') }}</span>
            </div>
        </div>
        <div class="mt-4 pt-4 border-t border-gray-50">
             <span class="block text-gray-400 text-xs mb-1">Keterangan Tambahan</span>
             <p class="text-gray-600 text-sm">{{ $permintaan->deskripsi_tambahan ?? '-' }}</p>
        </div>
    </div>

    <h3 class="font-bold text-xl text-[#022c22] mb-4">Penawaran Masuk ({{ $permintaan->penawarans->count() }})</h3>

    @if($permintaan->penawarans->count() > 0)
        <div class="space-y-4">
            @foreach($permintaan->penawarans as $offer)
                <div class="bg-white rounded-2xl border border-gray-100 p-6 flex flex-col md:flex-row gap-6 hover:shadow-md transition-all {{ $offer->status == 'rejected' ? 'opacity-50 grayscale' : '' }}">
                    <!-- Product Image -->
                    <div class="w-24 h-24 bg-gray-100 rounded-xl flex-shrink-0">
                         @if($offer->buah->gambar)
                            <img src="{{ asset('storage/' . $offer->buah->gambar) }}" class="w-full h-full object-cover rounded-xl">
                        @endif
                    </div>

                    <!-- Offer Details -->
                    <div class="flex-1">
                        <div class="flex justify-between items-start">
                             <div>
                                <h4 class="font-bold text-lg text-[#022c22]">{{ $offer->buah->nama_buah }}</h4>
                                <p class="text-sm text-gray-500">Petani: {{ $offer->petani->name }} • {{ $offer->petani->alamatPengguna->kota ?? '' }}</p>
                            </div>
                            <div class="text-right">
                                <span class="block font-bold text-xl text-[#022c22]">Rp {{ number_format($offer->harga_tawaran, 0, ',', '.') }}</span>
                                <span class="text-xs text-gray-400">per kg</span>
                            </div>
                        </div>

                        <div class="flex gap-2 my-3">
                             <span class="bg-gray-50 border border-gray-200 px-2 py-1 rounded text-xs font-bold text-gray-600">
                                Grade Skor: {{ number_format(($offer->buah->penilaian->total_skor_akhir ?? 0) * 5, 1) }}
                            </span>
                             <span class="bg-gray-50 border border-gray-200 px-2 py-1 rounded text-xs font-bold text-gray-600">
                                Stok: {{ $offer->buah->stok }} Kg
                            </span>
                        </div>

                        @if($offer->pesan)
                            <div class="bg-blue-50 p-3 rounded-lg text-sm text-blue-800 mb-3">
                                "{{ $offer->pesan }}"
                            </div>
                        @endif
                    </div>

                    <!-- Actions -->
                    <div class="flex flex-col justify-center gap-2 min-w-[150px]">
                        @if($offer->status == 'pending')
                            <form action="{{ route('penawaran.accept', $offer->id_penawaran) }}" method="POST">
                                @csrf
                                <button type="submit" onclick="return confirm('Apakah Anda yakin ingin menerima tawaran ini?');" class="w-full bg-[#022c22] text-white py-2 rounded-xl font-bold text-sm hover:bg-[#bef264] hover:text-[#022c22] transition-colors">
                                    Terima Tawaran
                                </button>
                            </form>
                            <form action="{{ route('penawaran.reject', $offer->id_penawaran) }}" method="POST">
                                @csrf
                                <button type="submit" onclick="return confirm('Yakin ingin menolak tawaran ini?');" class="w-full border border-red-200 text-red-600 py-2 rounded-xl font-bold text-sm hover:bg-red-50 transition-colors">
                                    Tolak
                                </button>
                            </form>
                        @elseif($offer->status == 'accepted')
                            <div class="bg-green-100 text-green-700 py-2 rounded-xl font-bold text-sm text-center">
                                ✓ Diterima
                            </div>
                            @php
                                // Check if transaction exists for this offer
                                $listing = \App\Models\Postingan::where('id_buah', $offer->id_buah)
                                    ->where('judul_posting', 'LIKE', 'Penawaran Khusus%')
                                    ->first();
                                $transaction = $listing ? \App\Models\Transaksi::where('id_postingan', $listing->id_posting)->first() : null;
                            @endphp

                            @if($transaction)
                                <a href="{{ route('transaksi.index') }}" class="block w-full bg-blue-50 text-blue-700 border border-blue-100 py-2 rounded-xl font-bold text-sm text-center hover:bg-blue-100 transition-colors">
                                    Lihat Pesanan
                                </a>
                            @else
                                <a href="{{ route('penawaran.checkout', $offer->id_penawaran) }}" class="block w-full bg-[#022c22] text-[#bef264] py-2 rounded-xl font-bold text-sm text-center hover:bg-[#033a2d]">
                                    Lanjut Bayar
                                </a>
                            @endif
                        @elseif($offer->status == 'rejected')
                            <div class="bg-red-100 text-red-700 py-2 rounded-xl font-bold text-sm text-center">
                                ✕ Ditolak
                            </div>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="bg-gray-50 border border-dashed border-gray-200 rounded-2xl p-8 text-center text-gray-500">
            Belum ada penawaran dari petani.
        </div>
    @endif
</x-dashboard-layout>
