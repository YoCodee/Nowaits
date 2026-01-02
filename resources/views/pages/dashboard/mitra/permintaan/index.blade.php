<x-dashboard-layout>
    <div class="flex items-center justify-between mb-8">
        <div>
            <h2 class="text-2xl font-bold text-[#022c22]">Permintaan Saya</h2>
            <p class="text-gray-500 text-sm">Daftar kebutuhan stok buah yang Anda cari.</p>
        </div>
        <a href="{{ route('permintaan-mitra.create') }}" class="bg-[#bef264] hover:bg-[#a3d945] text-[#022c22] px-6 py-2.5 rounded-xl font-bold transition-all shadow-lg hover:shadow-xl flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
            Buat Permintaan
        </a>
    </div>

    @if($permintaans->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($permintaans as $item)
                <div class="bg-white rounded-2xl border border-gray-100 p-6 shadow-sm hover:shadow-md transition-all group relative">
                     <span class="absolute top-6 right-6 px-3 py-1 rounded-full text-xs font-bold
                        @if($item->status_tawaran == 'aktif') bg-green-100 text-green-700
                        @elseif($item->status_tawaran == 'terpenuhi') bg-blue-100 text-blue-700
                        @else bg-gray-100 text-gray-700 @endif">
                        {{ ucfirst($item->status_tawaran) }}
                    </span>

                    <h3 class="font-bold text-lg text-[#022c22] mb-1 pr-16">{{ $item->nama_buah_dicari }}</h3>
                    <p class="text-gray-500 text-sm mb-4">Butuh: <span class="font-bold text-[#022c22]">{{ $item->jumlah_dicari_kg }} Kg</span></p>

                    <div class="bg-gray-50 p-4 rounded-xl mb-4 space-y-2">
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-500">Harga Ajuan</span>
                            <span class="font-bold text-[#022c22]">Rp {{ number_format($item->harga_ajuan_per_kg, 0, ',', '.') }} /kg</span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-500">Min. Kualitas</span>
                            <span class="font-bold text-[#022c22]">{{ $item->min_skor_kualitas * 100 }}%</span>
                        </div>
                    </div>

                    <p class="text-gray-500 text-sm mb-6 line-clamp-2 h-10">{{ $item->deskripsi_tambahan ?? '-' }}</p>

                    <div class="flex gap-2">
                        <a href="{{ route('permintaan-mitra.show', $item->id_permintaan) }}" class="flex-1 py-2 text-center text-sm font-bold text-white bg-[#022c22] rounded-lg hover:bg-[#033a2d] transition-colors relative">
                            Lihat Tawaran
                            @if($item->penawarans_count > 0)
                                <span class="absolute -top-2 -right-2 bg-red-500 text-white text-[10px] w-5 h-5 flex items-center justify-center rounded-full border-2 border-white">
                                    {{ $item->penawarans_count }}
                                </span>
                            @endif
                        </a>
                        <a href="{{ route('permintaan-mitra.edit', $item->id_permintaan) }}" class="flex-1 py-2 text-center text-sm font-bold text-gray-600 border border-gray-200 rounded-lg hover:bg-gray-50 transition-colors">
                            Edit
                        </a>
                        <form action="{{ route('permintaan-mitra.destroy', $item->id_permintaan) }}" method="POST" class="flex-1" onsubmit="return confirm('Hapus permintaan ini?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="w-full py-2 text-center text-sm font-bold text-red-600 border border-red-200 rounded-lg hover:bg-red-50 transition-colors">
                                Hapus
                            </button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="bg-white rounded-3xl p-12 text-center border border-dashed border-gray-300">
            <div class="w-16 h-16 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-4 text-gray-400">
                 <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
            </div>
            <h3 class="text-lg font-bold text-gray-900 mb-2">Belum ada permintaan</h3>
            <p class="text-gray-500 mb-6 max-w-sm mx-auto">Buat permintaan stok buah agar petani tahu apa yang sedang Anda cari.</p>
            <a href="{{ route('permintaan-mitra.create') }}" class="inline-flex items-center gap-2 bg-[#022c22] text-white px-6 py-3 rounded-xl font-bold hover:bg-[#033a2d] transition-colors">
                Buat Permintaan Baru
            </a>
        </div>
    @endif
</x-dashboard-layout>
