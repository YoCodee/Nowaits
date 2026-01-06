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
                <div class="bg-white rounded-2xl border border-gray-100 p-6 hover:shadow-md transition-all {{ $offer->status == 'rejected' ? 'opacity-50 grayscale' : '' }}">
                    <div class="flex flex-col md:flex-row gap-6 items-center">
                        
                        <!-- Left: Image & Info -->
                        <div class="flex-1 flex gap-4 items-start w-full">
                            <div class="w-20 h-20 bg-gray-100 rounded-xl flex-shrink-0 overflow-hidden">
                                @if($offer->buah->gambar)
                                    <img src="{{ asset('storage/' . $offer->buah->gambar) }}" class="w-full h-full object-cover">
                                @endif
                            </div>
                            <div>
                                <h4 class="font-bold text-lg text-[#022c22]">{{ $offer->buah->nama_buah }}</h4>
                                <p class="text-sm text-gray-500 mb-2">Petani: {{ $offer->petani->name }}</p>
                                
                                <div class="flex gap-2">
                                     <span class="bg-gray-50 border border-gray-200 px-2 py-1 rounded text-xs font-bold text-gray-600">
                                        Grade: {{ number_format(($offer->buah->penilaian->total_skor_akhir ?? 0) * 5, 1) }}
                                    </span>
                                     <span class="bg-gray-50 border border-gray-200 px-2 py-1 rounded text-xs font-bold text-gray-600">
                                        Stok: {{ $offer->buah->stok }} Kg
                                    </span>
                                </div>
                                @if($offer->pesan)
                                    <p class="text-xs text-blue-600 mt-2 bg-blue-50 px-2 py-1 rounded inline-block">"{{ $offer->pesan }}"</p>
                                @endif
                            </div>
                        </div>

                        <!-- Middle: Price Calculation -->
                        <div class="text-right md:text-center min-w-[200px]">
                                @php
                                    $estTotal = $offer->harga_tawaran * $permintaan->jumlah_dicari_kg;
                                    $estAdmin = $estTotal * 0.025;
                                    $ongkir = 0;
                                    $jarak = 0;
                                    $canCalcShipping = false;

                                    $buyerAddress = auth()->user()->alamatPengguna;
                                    $sellerAddress = $offer->petani->alamatPengguna;

                                    if ($buyerAddress && $buyerAddress->latitude && $sellerAddress && $sellerAddress->latitude) {
                                        $lat1 = $sellerAddress->latitude;
                                        $lon1 = $sellerAddress->longitude;
                                        $lat2 = $buyerAddress->latitude;
                                        $lon2 = $buyerAddress->longitude;
                                        $earthRadius = 6371; 
                                        $dLat = deg2rad($lat2 - $lat1);
                                        $dLon = deg2rad($lon2 - $lon1);
                                        $a = sin($dLat / 2) * sin($dLat / 2) + cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * sin($dLon / 2) * sin($dLon / 2);
                                        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));
                                        $jarak = $earthRadius * $c;
                                        $ongkir = ceil($jarak * 5000);
                                        $canCalcShipping = true;
                                    }
                                    $estGrandTotal = $estTotal + $estAdmin + $ongkir;
                                @endphp

                                <span class="block font-bold text-xl text-[#022c22]">Rp {{ number_format($estGrandTotal, 0, ',', '.') }}</span>
                                <span class="text-[10px] text-gray-400 block uppercase tracking-wider font-bold">Total (Inc. Ongkir & Admin)</span>
                                
                                <div class="mt-2 text-[10px] text-gray-500 space-y-0.5">
                                    <div class="flex justify-between md:justify-center gap-2">
                                        <span>Ongkir ({{ $canCalcShipping ? number_format($jarak, 1) . ' km' : '-' }}):</span>
                                        <span class="font-bold">{{ $canCalcShipping ? 'Rp ' . number_format($ongkir, 0, ',', '.') : 'Check Address' }}</span>
                                    </div>
                                    <div class="flex justify-between md:justify-center gap-2 text-gray-400">
                                        <span>Harga/kg:</span>
                                        <span>Rp {{ number_format($offer->harga_tawaran, 0, ',', '.') }}</span>
                                    </div>
                                </div>
                        </div>

                        <!-- Right: Actions -->
                        <div class="flex flex-col gap-2 w-full md:w-auto min-w-[140px]">
                            @if($offer->status == 'pending')
                                <form action="{{ route('penawaran.accept', $offer->id_penawaran) }}" method="POST">
                                    @csrf
                                    <button type="submit" onclick="return confirm('Terima tawaran ini?');" class="w-full bg-[#022c22] text-[#bef264] py-2 px-4 rounded-xl font-bold text-sm hover:bg-[#033a2d] transition-colors shadow-lg shadow-[#022c22]/20">
                                        Terima
                                    </button>
                                </form>
                                <form action="{{ route('chat.offer', $offer->id_penawaran) }}" method="POST">
                                    @csrf
                                    <button class="w-full bg-white border border-gray-200 text-gray-700 py-2 px-4 rounded-xl font-bold text-sm hover:bg-gray-50 transition-colors">
                                        Chat
                                    </button>
                                </form>
                                <form action="{{ route('penawaran.reject', $offer->id_penawaran) }}" method="POST">
                                    @csrf
                                    <button type="submit" onclick="return confirm('Tolak tawaran?');" class="w-full text-red-500 py-1 text-xs font-bold hover:underline">
                                        Tolak
                                    </button>
                                </form>
                            @elseif($offer->status == 'accepted')
                                <div class="bg-green-100 text-green-700 py-2 px-4 rounded-xl font-bold text-sm text-center mb-2">
                                    ✓ Diterima
                                </div>
                                @php
                                    // Robust way to find the transaction related to this accepted offer
                                    $transaction = \App\Models\Transaksi::where('id_pembeli', auth()->user()->id_pengguna)
                                        ->where('id_penjual', $offer->id_petani)
                                        ->whereHas('postingan', function($q) use ($offer) {
                                            $q->where('id_buah', $offer->id_buah);
                                        })
                                        ->whereIn('status', ['menunggu_pembayaran', 'menunggu_konfirmasi', 'diproses', 'dikirim', 'selesai'])
                                        ->latest()
                                        ->first();
                                @endphp

                                @if($transaction)
                                    @if($transaction->status == 'menunggu_pembayaran')
                                        <a href="{{ route('transaksi.payment', $transaction->id_transaksi) }}" class="block w-full bg-[#022c22] text-[#bef264] py-2 px-4 rounded-xl font-bold text-sm text-center hover:bg-[#033a2d]">
                                            Bayar Sekarang
                                        </a>
                                    @else
                                        <a href="{{ route('transaksi.index') }}" class="block w-full bg-blue-50 text-blue-700 border border-blue-100 py-2 px-4 rounded-xl font-bold text-sm text-center hover:bg-blue-100">
                                            Lihat Status
                                        </a>
                                    @endif
                                @else
                                    <span class="text-xs text-red-500 text-center block">Error: Transaksi tidak ditemukan.</span>
                                @endif
                            @elseif($offer->status == 'rejected')
                                <div class="bg-red-100 text-red-700 py-2 px-4 rounded-xl font-bold text-sm text-center">
                                    ✕ Ditolak
                                </div>
                            @endif
                        </div>
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
