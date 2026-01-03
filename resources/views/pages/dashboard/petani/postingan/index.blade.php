<x-dashboard-layout>
    <div class="flex items-center justify-between mb-8">
        <div>
            <h2 class="text-2xl font-bold text-[#022c22]">Postingan Marketplace</h2>
            <p class="text-gray-500 text-sm">Kelola penawaran Anda yang tampil di Marketplace.</p>
        </div>
        <a href="{{ route('postingan.create') }}" class="bg-[#bef264] hover:bg-[#a3d945] text-[#022c22] px-6 py-2.5 rounded-xl font-bold transition-all shadow-lg hover:shadow-xl flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 20h9"></path><path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"></path></svg>
            Buat Postingan Baru
        </a>
    </div>

    @if($postingans->count() > 0)
        <div class="space-y-4">
            @foreach($postingans as $post)
                <div class="bg-white rounded-2xl border border-gray-100 p-6 shadow-sm hover:shadow-md transition-all flex flex-col md:flex-row gap-6 items-start">
                    <div class="w-full md:w-32 h-32 bg-gray-100 rounded-xl overflow-hidden flex-shrink-0">
                        @if($post->buah->gambar)
                            <img src="{{ asset('storage/' . $post->buah->gambar) }}" class="w-full h-full object-cover">
                        @else
                            <div class="flex items-center justify-center h-full text-gray-400">
                                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><circle cx="8.5" cy="8.5" r="1.5"></circle><polyline points="21 15 16 10 5 21"></polyline></svg>
                            </div>
                        @endif
                    </div>

                    <div class="flex-1">
                        <div class="flex justify-between items-start mb-2">
                             <div>
                                <h3 class="font-bold text-lg text-[#022c22]">{{ $post->judul_posting }}</h3>
                                <p class="text-gray-500 text-sm mb-1">Stok: <span class="font-bold text-gray-700">{{ $post->buah->nama_buah }} ({{ $post->buah->stok }} Kg)</span></p>
                             </div>

                             <div class="flex items-center gap-2">
                                <span class="px-3 py-1 rounded-full text-xs font-bold
                                    @if($post->status == 'aktif') bg-green-100 text-green-700
                                    @elseif($post->status == 'terjual') bg-blue-100 text-blue-700
                                    @else bg-gray-100 text-gray-700 @endif">
                                    {{ ucfirst($post->status) }}
                                </span>
                             </div>
                        </div>

                        <p class="text-gray-600 text-sm mb-4 line-clamp-2">{{ $post->keterangan ?? 'Tidak ada keterangan tambahan.' }}</p>

                        <div class="flex items-center gap-4 text-sm text-gray-500">
                            <div class="flex items-center gap-1">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
                                {{ $post->created_at->diffForHumans() }}
                            </div>
                            <div class="font-bold text-[#022c22]">
                                Total Nilai: Rp {{ number_format($post->total_harga, 0, ',', '.') }}
                            </div>
                        </div>
                    </div>

                    <div class="flex flex-col gap-2 w-full md:w-auto">
                        <a href="{{ route('postingan.edit', $post->id_posting) }}" class="px-4 py-2 border border-gray-200 rounded-lg text-sm font-bold text-gray-600 hover:bg-gray-50 text-center transition-colors">
                            Edit
                        </a>
                        <form action="{{ route('postingan.destroy', $post->id_posting) }}" method="POST" onsubmit="return confirm('Hapus postingan ini?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="w-full px-4 py-2 border border-red-200 rounded-lg text-sm font-bold text-red-600 hover:bg-red-50 text-center transition-colors">
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
                 <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
            </div>
            <h3 class="text-lg font-bold text-gray-900 mb-2">Belum ada postingan</h3>
            <p class="text-gray-500 mb-6 max-w-sm mx-auto">Promosikan stok buah Anda ke Marketplace agar dilihat oleh Mitra.</p>
            <a href="{{ route('postingan.create') }}" class="inline-flex items-center gap-2 bg-[#022c22] text-white px-6 py-3 rounded-xl font-bold hover:bg-[#033a2d] transition-colors">
                Buat Postingan Pertama
            </a>
        </div>
    @endif
</x-dashboard-layout>
