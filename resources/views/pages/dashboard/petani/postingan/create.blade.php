<x-dashboard-layout>
    <div class="max-w-2xl mx-auto">
        <div class="flex items-center gap-4 mb-8">
            <a href="{{ route('postingan.index') }}" class="w-10 h-10 bg-white border border-gray-200 rounded-xl flex items-center justify-center text-gray-500 hover:text-[#022c22] hover:border-[#022c22] transition-all">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 12H5M12 19l-7-7 7-7"/></svg>
            </a>
            <div>
                <h2 class="text-2xl font-bold text-[#022c22]">Buat Postingan Baru</h2>
                <p class="text-gray-500 text-sm">Pilih stok buah yang ingin Anda pasarkan.</p>
            </div>
        </div>

        <form action="{{ route('postingan.store') }}" method="POST" class="space-y-6">
            @csrf

            <div class="bg-white p-8 rounded-3xl border border-gray-100 shadow-sm space-y-6">
                <!-- Pilih Stok Buah -->
                <div class="space-y-2">
                    <label class="text-sm font-bold text-gray-700">Pilih Stok Buah</label>
                    <select name="id_buah" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:border-[#bef264] focus:ring-1 focus:ring-[#bef264] transition-all" required>
                        <option value="" disabled selected>-- Pilih Stok Tersedia --</option>
                        @foreach($buahs as $buah)
                            <option value="{{ $buah->id_buah }}">
                                {{ $buah->nama_buah }} ({{ $buah->stok }} Kg) - Kualitas: {{ number_format($buah->penilaian->total_skor_akhir * 100, 0) }}%
                            </option>
                        @endforeach
                    </select>
                    @if($buahs->isEmpty())
                        <p class="text-xs text-red-500 mt-1">
                            Tidak ada stok tersedia. Silakan <a href="{{ route('buah.create') }}" class="underline font-bold">tambah stok</a> terlebih dahulu atau pastikan stok belum diposting.
                        </p>
                    @endif
                    @error('id_buah') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <!-- Judul Postingan -->
                <div class="space-y-2">
                    <label class="text-sm font-bold text-gray-700">Judul Postingan</label>
                    <input type="text" name="judul_posting" value="{{ old('judul_posting') }}" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:border-[#bef264] focus:ring-1 focus:ring-[#bef264] transition-all" placeholder="Contoh: Panen Raya Apel Malang Kualitas Super" required>
                    @error('judul_posting') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <!-- Keterangan -->
                <div class="space-y-2">
                    <label class="text-sm font-bold text-gray-700">Keterangan Tambahan (Opsional)</label>
                    <textarea name="keterangan" rows="4" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:border-[#bef264] focus:ring-1 focus:ring-[#bef264] transition-all" placeholder="Ceritakan lebih detail tentang penawaran ini...">{{ old('keterangan') }}</textarea>
                    @error('keterangan') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="pt-4 border-t border-gray-100">
                    <div class="bg-blue-50 p-4 rounded-xl flex gap-3 text-sm text-blue-800">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="16" x2="12" y2="12"></line><line x1="12" y1="8" x2="12.01" y2="8"></line></svg>
                        <p>Total harga akan dihitung otomatis: <strong>Stok (Kg) x Harga Akhir</strong> dari data buah yang dipilih.</p>
                    </div>
                </div>
            </div>

            <button type="submit" class="w-full bg-[#022c22] text-[#bef264] px-8 py-4 rounded-xl font-bold shadow-lg hover:shadow-xl hover:bg-[#033a2d] transition-all"
                @if($buahs->isEmpty()) disabled @endif>
                Terbitkan Postingan
            </button>
        </form>
    </div>
</x-dashboard-layout>
