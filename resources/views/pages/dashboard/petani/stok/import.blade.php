<x-dashboard-layout>
    <div class="max-w-xl mx-auto">
        <div class="flex items-center gap-4 mb-8">
            <a href="{{ route('buah.index') }}" class="w-10 h-10 bg-white border border-gray-200 rounded-xl flex items-center justify-center text-gray-500 hover:text-[#022c22] hover:border-[#022c22] transition-all">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 12H5M12 19l-7-7 7-7"/></svg>
            </a>
            <div>
                <h2 class="text-2xl font-bold text-[#022c22]">Import Bulk Stok</h2>
                <p class="text-gray-500 text-sm">Upload banyak data sekaligus menggunakan CSV.</p>
            </div>
        </div>

        <div class="bg-white p-8 rounded-3xl border border-gray-100 shadow-sm space-y-8">
            <div class="bg-[#bef264]/10 p-6 rounded-2xl border border-[#bef264]/20">
                <h3 class="font-bold text-[#022c22] mb-2 flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="12" y1="18" x2="12" y2="12"></line><line x1="9" y1="15" x2="15" y2="15"></line></svg>
                    Langkah 1: Unduh Template
                </h3>
                <p class="text-sm text-gray-600 mb-4">Gunakan template resmi kami agar format data sesuai. Jangan ubah urutan kolom.</p>
                <a href="{{ route('buah.template') }}" class="inline-flex items-center gap-2 bg-white px-4 py-2 rounded-xl text-sm font-bold text-[#022c22] shadow-sm hover:shadow hover:bg-gray-50 transition-all">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="7 10 12 15 17 10"></polyline><line x1="12" y1="15" x2="12" y2="3"></line></svg>
                    Download Template CSV
                </a>
            </div>

            <div>
                <h3 class="font-bold text-[#022c22] mb-4 flex items-center gap-2">
                    <span class="w-6 h-6 rounded-full bg-gray-100 flex items-center justify-center text-xs">2</span>
                    Langkah 2: Upload File CSV
                </h3>
                <form action="{{ route('buah.storeImport') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                    @csrf
                    <div class="relative border-2 border-dashed border-gray-300 rounded-2xl p-8 text-center hover:bg-gray-50 transition-colors cursor-pointer" onclick="document.getElementById('file').click()">
                        <input type="file" name="file" id="file" class="hidden" accept=".csv" onchange="document.getElementById('filename').innerText = this.files[0].name">
                        <div class="w-12 h-12 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-3 text-gray-400">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="17 8 12 3 7 8"></polyline><line x1="12" y1="3" x2="12" y2="15"></line></svg>
                        </div>
                        <p id="filename" class="text-sm text-gray-500 font-medium">Klik untuk pilih file CSV</p>
                    </div>
                    @error('file') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror

                    <div class="space-y-2 mt-4">
                         <label class="text-sm font-bold text-gray-700">Upload Foto-foto Buah (Opsional)</label>
                         <p class="text-xs text-gray-400 mb-2">Pastikan nama file foto sama persis dengan yang Anda tulis di kolom CSV.</p>
                         <input type="file" name="images[]" multiple accept="image/*" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:border-[#bef264] focus:ring-1 focus:ring-[#bef264] transition-all text-sm">
                    </div>

                    <button type="submit" class="w-full bg-[#022c22] text-[#bef264] px-6 py-4 rounded-xl font-bold shadow-lg hover:shadow-xl hover:bg-[#033a2d] transition-all flex items-center justify-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="17 8 12 3 7 8"></polyline><line x1="12" y1="3" x2="12" y2="15"></line></svg>
                        Mulai Import Data
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-dashboard-layout>
