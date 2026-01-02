<x-dashboard-layout>
    <div class="max-w-2xl mx-auto">
        <div class="flex items-center gap-4 mb-8">
            <a href="{{ route('postingan.index') }}" class="w-10 h-10 bg-white border border-gray-200 rounded-xl flex items-center justify-center text-gray-500 hover:text-[#022c22] hover:border-[#022c22] transition-all">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 12H5M12 19l-7-7 7-7"/></svg>
            </a>
            <div>
                <h2 class="text-2xl font-bold text-[#022c22]">Edit Postingan</h2>
                <p class="text-gray-500 text-sm">Perbarui informasi penawaran Anda.</p>
            </div>
        </div>

        <form action="{{ route('postingan.update', $postingan->id_posting) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <div class="bg-white p-8 rounded-3xl border border-gray-100 shadow-sm space-y-6">
                <!-- Info Buah (Read Only) -->
                 <div class="bg-gray-50 p-4 rounded-xl flex gap-4 items-center">
                    <div class="w-16 h-16 bg-gray-200 rounded-lg overflow-hidden flex-shrink-0">
                         @if($postingan->buah->gambar)
                            <img src="{{ asset('storage/' . $postingan->buah->gambar) }}" class="w-full h-full object-cover">
                        @else
                            <div class="flex items-center justify-center h-full text-gray-400">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><circle cx="8.5" cy="8.5" r="1.5"></circle><polyline points="21 15 16 10 5 21"></polyline></svg>
                            </div>
                        @endif
                    </div>
                    <div>
                        <p class="text-xs text-gray-400 font-bold uppercase tracking-wider">Stok Terpilih</p>
                        <h4 class="font-bold text-[#022c22]">{{ $postingan->buah->nama_buah }}</h4>
                        <p class="text-sm text-gray-600">Stok: {{ $postingan->buah->stok }} Kg | Harga Akhir: Rp {{ number_format($postingan->buah->harga_akhir, 0, ',', '.') }}</p>
                    </div>
                </div>

                <!-- Judul Postingan -->
                <div class="space-y-2">
                    <label class="text-sm font-bold text-gray-700">Judul Postingan</label>
                    <input type="text" name="judul_posting" value="{{ old('judul_posting', $postingan->judul_posting) }}" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:border-[#bef264] focus:ring-1 focus:ring-[#bef264] transition-all" required>
                    @error('judul_posting') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <!-- Status -->
                <div class="space-y-2">
                    <label class="text-sm font-bold text-gray-700">Status Postingan</label>
                    <select name="status" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:border-[#bef264] focus:ring-1 focus:ring-[#bef264] transition-all">
                        <option value="aktif" {{ $postingan->status == 'aktif' ? 'selected' : '' }}>Aktif (Tayang)</option>
                        <option value="terjual" {{ $postingan->status == 'terjual' ? 'selected' : '' }}>Terjual (Selesai)</option>
                        <option value="dibatalkan" {{ $postingan->status == 'dibatalkan' ? 'selected' : '' }}>Dibatalkan (Arsip)</option>
                    </select>
                    @error('status') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <!-- Keterangan -->
                <div class="space-y-2">
                    <label class="text-sm font-bold text-gray-700">Keterangan Tambahan</label>
                    <textarea name="keterangan" rows="4" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:border-[#bef264] focus:ring-1 focus:ring-[#bef264] transition-all">{{ old('keterangan', $postingan->keterangan) }}</textarea>
                    @error('keterangan') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="flex gap-4">
                 <a href="{{ route('postingan.index') }}" class="flex-1 py-4 text-center font-bold text-gray-500 hover:bg-gray-100 rounded-xl transition-all">
                    Batal
                </a>
                <button type="submit" class="flex-[2] bg-[#022c22] text-[#bef264] px-8 py-4 rounded-xl font-bold shadow-lg hover:shadow-xl hover:bg-[#033a2d] transition-all">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</x-dashboard-layout>
