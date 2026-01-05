<x-dashboard-layout>
    <div x-data="{ showGuide: false }" class="max-w-xl mx-auto relative">
        <div class="flex items-center justify-between gap-4 mb-8">
            <div class="flex items-center gap-4">
                <a href="{{ route('buah.index') }}" class="w-10 h-10 bg-white border border-gray-200 rounded-xl flex items-center justify-center text-gray-500 hover:text-[#022c22] hover:border-[#022c22] transition-all">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 12H5M12 19l-7-7 7-7"/></svg>
                </a>
                <div>
                    <h2 class="text-2xl font-bold text-[#022c22]">Import Bulk Stok</h2>
                    <p class="text-gray-500 text-sm">Upload banyak data sekaligus.</p>
                </div>
            </div>
            <button @click="showGuide = true" class="bg-white border border-gray-200 text-[#022c22] px-4 py-2 rounded-xl text-sm font-bold shadow-sm hover:bg-gray-50 transition-all flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"></path><line x1="12" y1="17" x2="12.01" y2="17"></line></svg>
                Petunjuk
            </button>
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

        <!-- Panduan Modal -->
        <div x-show="showGuide" 
             style="display: none;"
             class="fixed inset-0 z-50 flex items-center justify-center px-4 bg-black/50 backdrop-blur-sm"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0">
             
            <div class="bg-white w-full max-w-md rounded-3xl shadow-2xl overflow-hidden relative" 
                 x-data="{ step: 1 }"
                 @click.away="showGuide = false">
                 
                <!-- Header -->
                <div class="bg-[#022c22] p-6 text-white flex justify-between items-center">
                    <h3 class="text-xl font-bold">Panduan Import</h3>
                    <button @click="showGuide = false" class="text-white/70 hover:text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                    </button>
                </div>

                <!-- Slider Content -->
                <div class="p-8 h-64 flex flex-col items-center justify-center text-center">
                    
                    <div x-show="step === 1" x-transition:enter="transition ease-out duration-300 transform" x-transition:enter-start="opacity-0 translate-x-10" x-transition:enter-end="opacity-100 translate-x-0">
                        <div class="w-16 h-16 bg-[#bef264]/20 text-[#022c22] rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>
                        </div>
                        <h4 class="text-xl font-bold text-gray-800 mb-2">1. Klasifikasi Mandiri</h4>
                        <p class="text-gray-500">Petani harus mengklasifikasi kualitas buahnya sendiri (Grade A, B, atau C) secara manual sebelum memasukkan data.</p>
                    </div>

                    <div x-show="step === 2" style="display: none;" x-transition:enter="transition ease-out duration-300 transform" x-transition:enter-start="opacity-0 translate-x-10" x-transition:enter-end="opacity-100 translate-x-0">
                        <div class="w-16 h-16 bg-blue-100 text-blue-600 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="7 10 12 15 17 10"></polyline><line x1="12" y1="15" x2="12" y2="3"></line></svg>
                        </div>
                        <h4 class="text-xl font-bold text-gray-800 mb-2">2. Unduh Template</h4>
                        <p class="text-gray-500">Download file template CSV yang telah kami sediakan agar format kolom sesuai dengan sistem.</p>
                    </div>

                    <div x-show="step === 3" style="display: none;" x-transition:enter="transition ease-out duration-300 transform" x-transition:enter-start="opacity-0 translate-x-10" x-transition:enter-end="opacity-100 translate-x-0">
                        <div class="w-16 h-16 bg-green-100 text-green-600 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                        </div>
                        <h4 class="text-xl font-bold text-gray-800 mb-2">3. Isi Data ke CSV</h4>
                        <p class="text-gray-500">Masukkan data stok buah Anda ke dalam file CSV tersebut, lalu simpan dan upload kembali ke sini.</p>
                    </div>

                </div>

                <!-- Footer / Nav -->
                <div class="bg-gray-50 p-6 flex justify-between items-center">
                    <div class="flex gap-2">
                        <span class="w-2 h-2 rounded-full transition-colors" :class="step === 1 ? 'bg-[#022c22]' : 'bg-gray-300'"></span>
                        <span class="w-2 h-2 rounded-full transition-colors" :class="step === 2 ? 'bg-[#022c22]' : 'bg-gray-300'"></span>
                        <span class="w-2 h-2 rounded-full transition-colors" :class="step === 3 ? 'bg-[#022c22]' : 'bg-gray-300'"></span>
                    </div>

                    <div>
                        <button x-show="step > 1" @click="step--" class="text-gray-500 font-bold text-sm px-4 py-2 hover:text-gray-700">Kembali</button>
                        <button x-show="step < 3" @click="step++" class="bg-[#022c22] text-white px-6 py-2 rounded-xl font-bold text-sm shadow hover:bg-[#033a2d]">Lanjut</button>
                        <button x-show="step === 3" @click="showGuide = false" class="bg-[#bef264] text-[#022c22] px-6 py-2 rounded-xl font-bold text-sm shadow hover:bg-[#a9d953]">Mengerti</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-dashboard-layout>
