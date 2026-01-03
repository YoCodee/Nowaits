<x-dashboard-layout>
    <div class="max-w-xl mx-auto">
        <div class="flex items-center gap-4 mb-8">
            <a href="{{ route('permintaan-mitra.index') }}" class="w-10 h-10 bg-white border border-gray-200 rounded-xl flex items-center justify-center text-gray-500 hover:text-[#022c22] hover:border-[#022c22] transition-all">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 12H5M12 19l-7-7 7-7"/></svg>
            </a>
            <div>
                <h2 class="text-2xl font-bold text-[#022c22]">Buat Permintaan Baru</h2>
                <p class="text-gray-500 text-sm">Cari stok buah spesifik dari para petani.</p>
            </div>
        </div>

        <form action="{{ route('permintaan-mitra.store') }}" method="POST" class="space-y-6">
            @csrf

            <div class="bg-white p-8 rounded-3xl border border-gray-100 shadow-sm space-y-6">
                <!-- Nama Buah -->
                <div class="space-y-2">
                    <label class="text-sm font-bold text-gray-700">Buah yang Dicari</label>
                    <input type="text" name="nama_buah_dicari" value="{{ old('nama_buah_dicari') }}" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:border-[#bef264] focus:ring-1 focus:ring-[#bef264] transition-all" placeholder="Contoh: Apel Malang Grade A" required>
                    @error('nama_buah_dicari') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <!-- Jumlah -->
                    <div class="space-y-2">
                        <label class="text-sm font-bold text-gray-700">Jumlah (Kg)</label>
                        <input type="number" name="jumlah_dicari_kg" min="1" value="{{ old('jumlah_dicari_kg') }}" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:border-[#bef264] focus:ring-1 focus:ring-[#bef264] transition-all" placeholder="e.g. 100" required>
                        @error('jumlah_dicari_kg') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <!-- Harga Ajuan -->
                    <div class="space-y-2">
                        <label class="text-sm font-bold text-gray-700">Harga Ajuan / Kg</label>
                        <div class="relative">
                             <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 font-bold">Rp</span>
                             <input type="number" name="harga_ajuan_per_kg" min="0" value="{{ old('harga_ajuan_per_kg') }}" class="w-full pl-10 pr-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:border-[#bef264] focus:ring-1 focus:ring-[#bef264] transition-all" placeholder="0" required>
                        </div>
                        @error('harga_ajuan_per_kg') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>

                <!-- Kriteria Kualitas Detail -->
                <div class="space-y-6 pt-4 border-t border-gray-100">
                    <h3 class="font-bold text-gray-800">Kriteria Kualitas Minimal</h3>
                    <p class="text-sm text-gray-500 bg-blue-50 p-3 rounded-xl border border-blue-100">
                        Petani hanya bisa memberikan penawaran jika stok mereka memenuhi minimal skor kriteria ini.
                    </p>

                    <!-- Kulit -->
                    <div class="space-y-2">
                         <div class="flex justify-between mb-2">
                            <label class="text-sm font-bold text-gray-700">Minimal Skor Kulit</label>
                            <span class="text-[#022c22] font-bold" id="val_kulit">0.5</span>
                        </div>
                        <input type="range" name="min_skor_kulit" min="0" max="1" step="0.1" value="{{ old('min_skor_kulit', 0.5) }}" class="w-full h-2 bg-gray-200 rounded-lg appearance-none cursor-pointer accent-[#bef264]" oninput="document.getElementById('val_kulit').innerText = this.value">
                        <div class="flex justify-between text-xs text-gray-400 mt-1 font-medium">
                            <span>0: Apa Saja</span>
                            <span>0.5: Standar</span>
                            <span>1: Mulus</span>
                        </div>
                        @error('min_skor_kulit') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <!-- Bentuk -->
                    <div class="space-y-2">
                         <div class="flex justify-between mb-2">
                            <label class="text-sm font-bold text-gray-700">Minimal Skor Bentuk</label>
                            <span class="text-[#022c22] font-bold" id="val_bentuk">0.5</span>
                        </div>
                        <input type="range" name="min_skor_bentuk" min="0" max="1" step="0.1" value="{{ old('min_skor_bentuk', 0.5) }}" class="w-full h-2 bg-gray-200 rounded-lg appearance-none cursor-pointer accent-[#bef264]" oninput="document.getElementById('val_bentuk').innerText = this.value">
                        <div class="flex justify-between text-xs text-gray-400 mt-1 font-medium">
                            <span>0: Apa Saja</span>
                            <span>0.5: Standar</span>
                            <span>1: Sempurna</span>
                        </div>
                        @error('min_skor_bentuk') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <!-- Tekstur -->
                    <div class="space-y-2">
                         <div class="flex justify-between mb-2">
                            <label class="text-sm font-bold text-gray-700">Minimal Skor Tekstur</label>
                            <span class="text-[#022c22] font-bold" id="val_tekstur">0.5</span>
                        </div>
                        <input type="range" name="min_skor_tekstur" min="0" max="1" step="0.1" value="{{ old('min_skor_tekstur', 0.5) }}" class="w-full h-2 bg-gray-200 rounded-lg appearance-none cursor-pointer accent-[#bef264]" oninput="document.getElementById('val_tekstur').innerText = this.value">
                        <div class="flex justify-between text-xs text-gray-400 mt-1 font-medium">
                            <span>0: Apa Saja</span>
                            <span>0.5: Standar</span>
                            <span>1: Segar/Keras</span>
                        </div>
                        @error('min_skor_tekstur') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>

                <!-- Deskripsi -->
                <div class="space-y-2">
                    <label class="text-sm font-bold text-gray-700">Catatan Tambahan (Opsional)</label>
                    <textarea name="deskripsi_tambahan" rows="3" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:border-[#bef264] focus:ring-1 focus:ring-[#bef264] transition-all" placeholder="Misal: Dikirim maksimal lusa, packing kardus...">{{ old('deskripsi_tambahan') }}</textarea>
                    @error('deskripsi_tambahan') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            <button type="submit" class="w-full bg-[#022c22] text-[#bef264] px-8 py-4 rounded-xl font-bold shadow-lg hover:shadow-xl hover:bg-[#033a2d] transition-all">
                Terbitkan Permintaan
            </button>
        </form>
    </div>
</x-dashboard-layout>




