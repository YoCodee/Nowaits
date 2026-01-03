<x-guest-layout>
    <div class="min-h-screen bg-[#f3f4f6] flex items-center justify-center p-4">
        <div class="bg-white max-w-lg w-full rounded-2xl shadow-xl overflow-hidden">
            <!-- Header -->
            <div class="bg-[#022c22] p-6 text-white relative">
                <a href="{{ route('marketplace.index', ['tab' => 'cari']) }}" class="absolute top-6 left-6 text-white/70 hover:text-white transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>
                </a>
                <h2 class="text-xl font-bold text-center">Buat Penawaran</h2>
                <p class="text-center text-sm text-[#bef264] mt-1">ke {{ $permintaan->user->name }}</p>
            </div>

            <!-- Request Info -->
            <div class="p-6 bg-gray-50 border-b border-gray-100">
                <div class="flex justify-between items-start mb-2">
                    <h3 class="font-bold text-gray-800">Dicari: {{ $permintaan->nama_buah_dicari }}</h3>
                    <span class="bg-blue-100 text-blue-700 text-xs font-bold px-2 py-1 rounded">{{ $permintaan->jumlah_dicari_kg }} Kg</span>
                </div>
                <p class="text-sm text-gray-500 mb-2">{{ Str::limit($permintaan->deskripsi_tambahan, 100) }}</p>
                <div class="flex items-center gap-2 text-xs font-bold text-gray-400">
                    <span class="bg-white border border-gray-200 px-2 py-1 rounded">Budget: Rp {{ number_format($permintaan->harga_ajuan_per_kg, 0, ',', '.') }}</span>
                    <span class="bg-white border border-gray-200 px-2 py-1 rounded">Min Skor: {{ $permintaan->min_skor_kualitas }}</span>
                </div>
            </div>

            <!-- Form -->
            <form action="{{ route('penawaran.store', $permintaan->id_permintaan) }}" method="POST" class="p-6 space-y-4">
                @csrf

                <div x-data="{ grade: '' }">
                    <label class="block text-sm font-bold text-gray-700 mb-2">Pilih Stok Buah Anda</label>
                    <select name="id_buah" required
                        @change="grade = $event.target.selectedOptions[0].dataset.grade"
                        class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-[#022c22]">
                        <option value="" data-grade="">-- Pilih Produk --</option>
                        @foreach($buahs as $buah)
                            <option value="{{ $buah->id_buah }}" data-grade="{{ $buah->penilaian->total_skor_akhir }}">
                                {{ $buah->nama_buah }} (Stok: {{ $buah->stok }}kg)
                            </option>
                        @endforeach
                    </select>

                    <!-- Dynamic Grade Field -->
                    <div class="mt-4">
                        <label class="block text-sm font-bold text-gray-700 mb-2">Grade / Total Akhir</label>
                        <input type="text" x-model="grade" readonly placeholder="Otomatis terisi dari stok" class="w-full bg-gray-100 border border-gray-200 rounded-xl px-4 py-3 text-sm text-gray-500 cursor-not-allowed">
                        <p class="text-xs text-gray-400 mt-1">Nilai kualitas berdasarkan penilaian sistem.</p>
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Harga Tawaran per Kg</label>
                    <div class="relative">
                        <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 font-bold">Rp</span>
                        <input type="number" name="harga_tawaran" required placeholder="0" class="w-full bg-gray-50 border border-gray-200 rounded-xl pl-10 pr-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-[#022c22]">
                    </div>
                    <p class="text-xs text-gray-400 mt-1">Saran: Dekati budget mitra (Rp {{ number_format($permintaan->harga_ajuan_per_kg, 0, ',', '.') }})</p>
                </div>

                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Pesan Tambahan (Opsional)</label>
                    <textarea name="pesan" rows="3" placeholder="Contoh: Stok saya sangat segar, baru panen pagi ini..." class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-[#022c22]"></textarea>
                </div>

                <button type="submit" class="w-full bg-[#022c22] text-[#bef264] py-3 rounded-xl font-bold shadow-lg hover:bg-[#033a2d] transition-all mt-4">
                    Kirim Penawaran
                </button>
            </form>
        </div>
    </div>
</x-guest-layout>
