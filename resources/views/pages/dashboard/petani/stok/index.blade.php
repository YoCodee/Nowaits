<x-dashboard-layout>
    <div class="flex items-center justify-between mb-8">
        <div>
            <h2 class="text-2xl font-bold text-[#022c22]">Stok Buah Saya</h2>
            <p class="text-gray-500 text-sm">Kelola stok buah yang siap untuk dipasarkan.</p>
        </div>
        <div class="flex gap-3">
            <a href="{{ route('buah.import') }}" class="bg-white border border-gray-200 hover:bg-gray-50 text-gray-600 px-6 py-2.5 rounded-xl font-bold transition-all shadow-sm hover:shadow flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="17 8 12 3 7 8"></polyline><line x1="12" y1="3" x2="12" y2="15"></line></svg>
                Import Bulk
            </a>
            <a href="{{ route('buah.create') }}" class="bg-[#bef264] hover:bg-[#a3d945] text-[#022c22] px-6 py-2.5 rounded-xl font-bold transition-all shadow-lg hover:shadow-xl flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                Tambah Stok
            </a>
        </div>
    </div>

    @if($buahs->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($buahs as $buah)
                <div class="bg-white rounded-2xl border border-gray-100 overflow-hidden shadow-sm hover:shadow-md transition-all group">
                    <div class="relative h-48 bg-gray-100 overflow-hidden">
                        @if($buah->gambar)
                            <img src="{{ asset('storage/' . $buah->gambar) }}" alt="{{ $buah->nama_buah }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                        @else
                           <div class="flex items-center justify-center h-full text-gray-400">
                               <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><circle cx="8.5" cy="8.5" r="1.5"></circle><polyline points="21 15 16 10 5 21"></polyline></svg>
                           </div>
                        @endif

                         <div class="absolute top-4 right-4 bg-white/90 backdrop-blur-sm px-3 py-1 rounded-lg text-xs font-bold text-[#022c22] shadow-sm">
                            Skor: {{ number_format($buah->penilaian->total_skor_akhir ?? 0, 2) }}
                        </div>
                    </div>

                    <div class="p-5">
                        <h3 class="font-bold text-lg text-[#022c22] mb-1">{{ $buah->nama_buah }}</h3>
                        <div class="flex items-baseline gap-2 mb-4">
                            <p class="text-[#022c22] font-bold text-lg">Rp {{ number_format($buah->harga_akhir, 0, ',', '.') }} <span class="text-sm font-normal text-gray-500">/ kg</span></p>
                            @if($buah->harga_akhir < $buah->harga_awal)
                                <p class="text-xs text-gray-400 line-through">Rp {{ number_format($buah->harga_awal, 0, ',', '.') }}</p>
                            @endif
                        </div>

                        <div class="grid grid-cols-2 gap-2 mb-4">
                            <div class="bg-gray-50 p-2 rounded-lg text-center">
                                <span class="block text-[10px] text-gray-400 uppercase tracking-wider font-bold">Kulit</span>
                                <span class="font-bold text-sm">{{ number_format($buah->penilaian->skor_kulit ?? 0, 1) }}</span>
                            </div>
                            <div class="bg-gray-50 p-2 rounded-lg text-center">
                                <span class="block text-[10px] text-gray-400 uppercase tracking-wider font-bold">Bentuk</span>
                                <span class="font-bold text-sm">{{ number_format($buah->penilaian->skor_bentuk ?? 0, 1) }}</span>
                            </div>
                        </div>

                        <div class="flex gap-2 border-t border-gray-100 pt-4">
                            <a href="{{ route('buah.edit', $buah->id_buah) }}" class="flex-1 py-2 text-center text-sm font-bold text-gray-600 border border-gray-200 rounded-lg hover:bg-gray-50 transition-colors">
                                Edit
                            </a>
                            <form action="{{ route('buah.destroy', $buah->id_buah) }}" method="POST" class="flex-1" onsubmit="return confirm('Yakin ingin menghapus stok ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="w-full py-2 text-center text-sm font-bold text-red-600 border border-red-200 rounded-lg hover:bg-red-50 transition-colors">
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="bg-white rounded-3xl p-12 text-center border border-dashed border-gray-300">
            <div class="w-16 h-16 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-4 text-gray-400">
                 <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path><polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline><line x1="12" y1="22.08" x2="12" y2="12"></line></svg>
            </div>
            <h3 class="text-lg font-bold text-gray-900 mb-2">Belum ada stok buah</h3>
            <p class="text-gray-500 mb-6 max-w-sm mx-auto">Mulai tambahkan hasil panen Anda untuk menjangkau mitra tani.</p>
            <a href="{{ route('buah.create') }}" class="inline-flex items-center gap-2 bg-[#022c22] text-white px-6 py-3 rounded-xl font-bold hover:bg-[#033a2d] transition-colors">
                Tambah Stok Pertama
            </a>
        </div>
    @endif
</x-dashboard-layout>
