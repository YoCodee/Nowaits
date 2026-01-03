<x-dashboard-layout>
    <div class="max-w-xl mx-auto">
        <div class="flex items-center gap-4 mb-8">
            <a href="{{ route('permintaan-mitra.index') }}" class="w-10 h-10 bg-white border border-gray-200 rounded-xl flex items-center justify-center text-gray-500 hover:text-[#022c22] hover:border-[#022c22] transition-all">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 12H5M12 19l-7-7 7-7"/></svg>
            </a>
            <div>
                <h2 class="text-2xl font-bold text-[#022c22]">Edit Permintaan</h2>
                <p class="text-gray-500 text-sm">Perbarui detail kebutuhan stok Anda.</p>
            </div>
        </div>

        <form action="{{ route('permintaan-mitra.update', $permintaan->id_permintaan) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <div class="bg-white p-8 rounded-3xl border border-gray-100 shadow-sm space-y-6">
                <!-- Nama Buah -->
                <div class="space-y-2">
                    <label class="text-sm font-bold text-gray-700">Buah yang Dicari</label>
                    <input type="text" name="nama_buah_dicari" value="{{ old('nama_buah_dicari', $permintaan->nama_buah_dicari) }}" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:border-[#bef264] focus:ring-1 focus:ring-[#bef264] transition-all" required>
                    @error('nama_buah_dicari') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <!-- Jumlah -->
                    <div class="space-y-2">
                        <label class="text-sm font-bold text-gray-700">Jumlah (Kg)</label>
                        <input type="number" name="jumlah_dicari_kg" min="1" value="{{ old('jumlah_dicari_kg', $permintaan->jumlah_dicari_kg) }}" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:border-[#bef264] focus:ring-1 focus:ring-[#bef264] transition-all" required>
                        @error('jumlah_dicari_kg') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <!-- Harga Ajuan -->
                    <div class="space-y-2">
                        <label class="text-sm font-bold text-gray-700">Harga Ajuan / Kg</label>
                        <div class="relative">
                             <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 font-bold">Rp</span>
                             <input type="number" name="harga_ajuan_per_kg" min="0" value="{{ old('harga_ajuan_per_kg', $permintaan->harga_ajuan_per_kg) }}" class="w-full pl-10 pr-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:border-[#bef264] focus:ring-1 focus:ring-[#bef264] transition-all" required>
                        </div>
                        @error('harga_ajuan_per_kg') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>

                <!-- Min Skor Kualitas -->
                <div class="space-y-2">
                     <div class="flex justify-between mb-2">
                        <label class="text-sm font-bold text-gray-700">Minimal Kualitas (Skor)</label>
                        <span class="text-[#022c22] font-bold" id="val_skor">{{ $permintaan->min_skor_kualitas }}</span>
                    </div>
                    <input type="range" name="min_skor_kualitas" min="0" max="1" step="0.1" value="{{ old('min_skor_kualitas', $permintaan->min_skor_kualitas) }}" class="w-full h-2 bg-gray-200 rounded-lg appearance-none cursor-pointer accent-[#bef264]" oninput="document.getElementById('val_skor').innerText = this.value">
                    <div class="flex justify-between text-xs text-gray-400 mt-1 font-medium">
                        <span>0: Apa Saja</span>
                        <span>0.5: Standar</span>
                        <span>1: Premium</span>
                    </div>
                    @error('min_skor_kualitas') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <!-- Status -->
                <div class="space-y-2">
                    <label class="text-sm font-bold text-gray-700">Status Permintaan</label>
                    <select name="status_tawaran" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:border-[#bef264] focus:ring-1 focus:ring-[#bef264] transition-all">
                        <option value="aktif" {{ $permintaan->status_tawaran == 'aktif' ? 'selected' : '' }}>Aktif (Mencari)</option>
                        <option value="terpenuhi" {{ $permintaan->status_tawaran == 'terpenuhi' ? 'selected' : '' }}>Terpenuhi (Selesai)</option>
                        <option value="dibatalkan" {{ $permintaan->status_tawaran == 'dibatalkan' ? 'selected' : '' }}>Dibatalkan</option>
                    </select>
                    @error('status_tawaran') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <!-- Deskripsi -->
                <div class="space-y-2">
                    <label class="text-sm font-bold text-gray-700">Catatan Tambahan</label>
                    <textarea name="deskripsi_tambahan" rows="3" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:border-[#bef264] focus:ring-1 focus:ring-[#bef264] transition-all">{{ old('deskripsi_tambahan', $permintaan->deskripsi_tambahan) }}</textarea>
                    @error('deskripsi_tambahan') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="flex gap-4">
                 <a href="{{ route('permintaan-mitra.index') }}" class="flex-1 py-4 text-center font-bold text-gray-500 hover:bg-gray-100 rounded-xl transition-all">
                    Batal
                </a>
                <button type="submit" class="flex-[2] bg-[#022c22] text-[#bef264] px-8 py-4 rounded-xl font-bold shadow-lg hover:shadow-xl hover:bg-[#033a2d] transition-all">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</x-dashboard-layout>
