<x-dashboard-layout>
    <div class="max-w-4xl mx-auto">
        <div class="flex items-center gap-4 mb-8">
            <a href="{{ route('buah.index') }}" class="w-10 h-10 bg-white border border-gray-200 rounded-xl flex items-center justify-center text-gray-500 hover:text-[#022c22] hover:border-[#022c22] transition-all">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 12H5M12 19l-7-7 7-7"/></svg>
            </a>
            <div>
                <h2 class="text-2xl font-bold text-[#022c22]">Tambah Stok Buah</h2>
                <p class="text-gray-500 text-sm">Isi detail buah dan lakukan penilaian mandiri.</p>
            </div>
        </div>

        <form action="{{ route('buah.store') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
            @csrf

            {{-- 1. Informasi Dasar --}}
            <div class="bg-white p-8 rounded-3xl border border-gray-100 shadow-sm">
                <h3 class="font-bold text-lg text-[#022c22] mb-6 flex items-center gap-2">
                    <span class="w-8 h-8 rounded-lg bg-[#bef264]/20 flex items-center justify-center text-[#022c22] text-sm">1</span>
                    Informasi Dasar
                </h3>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-2">
                        <label class="text-sm font-bold text-gray-700">Nama Buah</label>
                        <input type="text" name="nama_buah" value="{{ old('nama_buah') }}" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:border-[#bef264] focus:ring-1 focus:ring-[#bef264] transition-all" placeholder="Contoh: Apel Manalagi">
                         @error('nama_buah') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="space-y-2">
                        <label class="text-sm font-bold text-gray-700">Harga Awal (Per Kg)</label>
                        <div class="relative">
                            <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 font-bold">Rp</span>
                            <input type="number" name="harga_awal" value="{{ old('harga_awal') }}" class="w-full pl-10 pr-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:border-[#bef264] focus:ring-1 focus:ring-[#bef264] transition-all" placeholder="0">
                        </div>
                        @error('harga_awal') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="md:col-span-2 space-y-2">
                        <label class="text-sm font-bold text-gray-700">Foto Buah</label>
                        <div class="relative border-2 border-dashed border-gray-300 rounded-2xl p-8 text-center hover:bg-gray-50 transition-colors cursor-pointer" onclick="document.getElementById('gambar').click()">
                            <input type="file" name="gambar" id="gambar" class="hidden" accept="image/*" onchange="previewImage(this)">
                            <div id="upload-placeholder">
                                <div class="w-12 h-12 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-3 text-gray-400">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><circle cx="8.5" cy="8.5" r="1.5"></circle><polyline points="21 15 16 10 5 21"></polyline></svg>
                                </div>
                                <p class="text-sm text-gray-500 font-medium">Klik untuk upload foto buah</p>
                                <p class="text-xs text-gray-400 mt-1">JPG, PNG, GIF max 2MB</p>
                            </div>
                            <img id="preview" class="hidden absolute inset-0 w-full h-full object-cover rounded-2xl" />
                        </div>
                         @error('gambar') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>
            </div>

            {{-- 2. Penilaian Kualitas --}}
            <div class="bg-white p-8 rounded-3xl border border-gray-100 shadow-sm">
                 <h3 class="font-bold text-lg text-[#022c22] mb-6 flex items-center gap-2">
                    <span class="w-8 h-8 rounded-lg bg-[#bef264]/20 flex items-center justify-center text-[#022c22] text-sm">2</span>
                    Penilaian Kualitas Mandiri
                </h3>
                <p class="text-gray-500 text-sm mb-8 bg-blue-50 p-4 rounded-xl border border-blue-100">
                    ℹ️ Geser slider sesuai dengan kondisi nyata buah Anda. Penilaian jujur meningkatkan kepercayaan Mitra.
                </p>

                <div class="space-y-8">
                    {{-- Kulit --}}
                    <div>
                        <div class="flex justify-between mb-2">
                            <label class="font-bold text-gray-700">Kondisi Kulit</label>
                            <span class="text-[#022c22] font-bold" id="val_kulit">0.5</span>
                        </div>
                        <input type="range" name="skor_kulit" min="0" max="1" step="0.1" value="{{ old('skor_kulit', 0.5) }}" class="w-full h-2 bg-gray-200 rounded-lg appearance-none cursor-pointer accent-[#bef264]" oninput="document.getElementById('val_kulit').innerText = this.value">
                        <div class="flex justify-between text-xs text-gray-400 mt-2 mb-3 font-medium">
                            <span class="w-1/3">0: Keriput/Berlubang</span>
                            <span class="w-1/3 text-center">0.5: Salah satu cacat</span>
                            <span class="w-1/3 text-right">1: Sempurna</span>
                        </div>
                        <textarea name="deskripsi_kulit" rows="2" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:border-[#bef264] focus:ring-1 focus:ring-[#bef264] transition-all text-sm" placeholder="Deskripsi kondisi kulit...">{{ old('deskripsi_kulit') }}</textarea>
                         @error('skor_kulit') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    {{-- Bentuk --}}
                    <div>
                         <div class="flex justify-between mb-2">
                            <label class="font-bold text-gray-700">Bentuk Umum (Nutrisi)</label>
                            <span class="text-[#022c22] font-bold" id="val_bentuk">0.5</span>
                        </div>
                        <input type="range" name="skor_bentuk" min="0" max="1" step="0.1" value="{{ old('skor_bentuk', 0.5) }}" class="w-full h-2 bg-gray-200 rounded-lg appearance-none cursor-pointer accent-[#bef264]" oninput="document.getElementById('val_bentuk').innerText = this.value">
                        <div class="flex justify-between text-xs text-gray-400 mt-2 mb-3 font-medium">
                            <span class="w-1/3">0: Cacat Pertumbuhan</span>
                             <span class="w-1/3 text-center">0.5: Standar</span>
                            <span class="w-1/3 text-right">1: Ideal/Premium</span>
                        </div>
                        <textarea name="deskripsi_bentuk" rows="2" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:border-[#bef264] focus:ring-1 focus:ring-[#bef264] transition-all text-sm" placeholder="Deskripsi kondisi bentuk...">{{ old('deskripsi_bentuk') }}</textarea>
                         @error('skor_bentuk') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    {{-- Tekstur --}}
                    <div>
                         <div class="flex justify-between mb-2">
                            <label class="font-bold text-gray-700">Tekstur & Warna</label>
                            <span class="text-[#022c22] font-bold" id="val_tekstur">0.5</span>
                        </div>
                        <input type="range" name="skor_tekstur" min="0" max="1" step="0.1" value="{{ old('skor_tekstur', 0.5) }}" class="w-full h-2 bg-gray-200 rounded-lg appearance-none cursor-pointer accent-[#bef264]" oninput="document.getElementById('val_tekstur').innerText = this.value">
                         <div class="flex justify-between text-xs text-gray-400 mt-2 mb-3 font-medium">
                            <span class="w-1/3">0: Lembek/Terlalu Matang</span>
                            <span class="w-1/3 text-center">0.5: Standar</span>
                            <span class="w-1/3 text-right">1: Matang Sempurna</span>
                        </div>
                        <textarea name="deskripsi_tekstur" rows="2" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:border-[#bef264] focus:ring-1 focus:ring-[#bef264] transition-all text-sm" placeholder="Deskripsi kondisi tekstur...">{{ old('deskripsi_tekstur') }}</textarea>
                         @error('skor_tekstur') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>
            </div>

            {{-- 3. Stok --}}
            <div class="bg-white p-8 rounded-3xl border border-gray-100 shadow-sm">
                <h3 class="font-bold text-lg text-[#022c22] mb-6 flex items-center gap-2">
                    <span class="w-8 h-8 rounded-lg bg-[#bef264]/20 flex items-center justify-center text-[#022c22] text-sm">3</span>
                    Kuantitas Stok
                </h3>
                <div class="space-y-2">
                    <label class="text-sm font-bold text-gray-700">Jumlah Stok (Kg)</label>
                    <input type="number" name="stok" min="1" value="{{ old('stok') }}" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:border-[#bef264] focus:ring-1 focus:ring-[#bef264] transition-all" placeholder="Masukkan jumlah stok dalam Kg">
                    @error('stok') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="flex justify-end pt-4">
                <button type="submit" class="bg-[#022c22] text-[#bef264] px-8 py-4 rounded-xl font-bold shadow-lg hover:shadow-xl hover:bg-[#033a2d] transition-all w-full md:w-auto">
                    Simpan Stok Buah
                </button>
            </div>
        </form>
    </div>

    <script>
        function previewImage(input) {
            const preview = document.getElementById('preview');
            const placeholder = document.getElementById('upload-placeholder');

            if (input.files && input.files[0]) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.classList.remove('hidden');
                    placeholder.classList.add('hidden');
                }

                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
</x-dashboard-layout>
