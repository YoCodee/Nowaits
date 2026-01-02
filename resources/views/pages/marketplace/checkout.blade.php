<x-guest-layout>
    <div class="min-h-screen bg-[#f3f4f6] pb-20">
        <!-- Header -->
        <div class="bg-white border-b border-gray-100 sticky top-0 z-50">
            <div class="max-w-4xl mx-auto px-4 h-16 flex items-center justify-between">
                <a href="{{ route('marketplace.show', $postingan->id_posting) }}" class="flex items-center gap-2 text-gray-500 hover:text-[#022c22] transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>
                    <span class="font-bold">Batal</span>
                </a>
                <span class="font-bold text-lg text-gray-800">Checkout</span>
                <div class="w-8"></div> <!-- Spacer -->
            </div>
        </div>

        <div class="max-w-4xl mx-auto px-4 py-8">
            <form action="{{ route('transaksi.store') }}" method="POST"
                  x-data="{
                      qty: 1,
                      price: {{ $postingan->buah->harga_akhir }},
                      ongkir: {{ $ongkir }},
                      maxStock: {{ $postingan->buah->stok }}
                  }">
                @csrf
                <input type="hidden" name="id_postingan" value="{{ $postingan->id_posting }}">
                <input type="hidden" name="custom_price" value="{{ $postingan->buah->harga_akhir }}">

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <!-- Left: Details -->
                    <div class="md:col-span-2 space-y-6">

                        <!-- Product Item -->
                        <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100">
                            <h3 class="font-bold text-gray-800 mb-4 border-b border-gray-100 pb-2">Rincian Barang</h3>
                            <div class="flex gap-4">
                                @if($postingan->buah->gambar)
                                    <img src="{{ asset('storage/' . $postingan->buah->gambar) }}" class="w-20 h-20 rounded-xl object-cover bg-gray-50">
                                @else
                                    <div class="w-20 h-20 rounded-xl bg-gray-50 flex items-center justify-center text-gray-400">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><circle cx="8.5" cy="8.5" r="1.5"></circle><polyline points="21 15 16 10 5 21"></polyline></svg>
                                    </div>
                                @endif
                                <div class="flex-1">
                                    <h4 class="font-bold text-gray-900 text-lg">{{ $postingan->judul_posting }}</h4>
                                    <p class="text-xs text-gray-500 mb-2">{{ $postingan->user->name }}</p>
                                    <div class="text-[#022c22] font-bold">Rp {{ number_format($postingan->buah->harga_akhir, 0, ',', '.') }} / kg</div>
                                </div>
                            </div>

                            <div class="mt-6">
                                <label class="block text-xs font-bold text-gray-500 mb-2">Jumlah Pembelian (Kg)</label>
                                <div class="flex items-center gap-4">
                                    <button type="button" @click="qty > 1 ? qty-- : null" class="w-10 h-10 rounded-xl bg-gray-100 flex items-center justify-center text-gray-600 hover:bg-gray-200 font-bold">-</button>
                                    <input type="number" name="jumlah_kg" x-model="qty" class="w-20 text-center font-bold border-gray-200 rounded-xl focus:ring-[#bef264] focus:border-[#bef264]" min="1" :max="maxStock">
                                    <button type="button" @click="qty < maxStock ? qty++ : null" class="w-10 h-10 rounded-xl bg-gray-100 flex items-center justify-center text-gray-600 hover:bg-gray-200 font-bold">+</button>
                                    <span class="text-sm text-gray-400">Stok: {{ $postingan->buah->stok }} Kg</span>
                                </div>
                            </div>
                        </div>

                        <!-- Shipping Address -->
                        <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100">
                            <h3 class="font-bold text-gray-800 mb-4 border-b border-gray-100 pb-2">Alamat Pengiriman</h3>
                            <div class="flex gap-3 items-start">
                                <div class="mt-1 text-[#022c22]">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>
                                </div>
                                <div>
                                    <p class="font-bold text-gray-900">{{ $user->name }} <span class="text-gray-400 font-normal">({{ $user->alamatPengguna->label_alamat }})</span></p>
                                    <p class="text-sm text-gray-600 mt-1 leading-relaxed">{{ $user->alamatPengguna->alamat_lengkap }}</p>

                                    @if($canCalculateShipping)
                                        <div class="mt-3 inline-flex items-center gap-2 bg-[#bef264]/20 px-3 py-1.5 rounded-lg">
                                            <span class="text-xs font-bold text-[#022c22]">Jarak: {{ number_format($jarak, 1) }} KM</span>
                                        </div>
                                    @else
                                        <div class="mt-3 bg-red-50 text-red-600 text-xs px-3 py-2 rounded-lg">
                                            Lokasi tidak terdeteksi. Pastikan Anda punya titik kordinat di profil.
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                    </div>

                    <!-- Right: Summary -->
                    <div class="md:col-span-1">
                        <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 sticky top-24">
                            <h3 class="font-bold text-gray-800 mb-6">Ringkasan Belanja</h3>

                            <div class="space-y-3 mb-6">
                                <div class="flex justify-between text-sm text-gray-600">
                                    <span>Total Harga (<span x-text="qty"></span> kg)</span>
                                    <span class="font-bold text-gray-900">Rp <span x-text="(price * qty).toLocaleString('id-ID')"></span></span>
                                </div>
                                <div class="flex justify-between text-sm text-gray-600">
                                    <span>Biaya Ongkir ({{ number_format($jarak, 0) }} km)</span>
                                    <span class="font-bold text-gray-900">Rp <span x-text="ongkir.toLocaleString('id-ID')"></span></span>
                                </div>
                            </div>

                            <div class="border-t border-gray-100 pt-4 mb-6">
                                <div class="flex justify-between items-center">
                                    <span class="font-bold text-gray-800">Total Tagihan</span>
                                    <span class="font-bold text-xl text-[#022c22]">Rp <span x-text="(price * qty + ongkir).toLocaleString('id-ID')"></span></span>
                                </div>
                            </div>

                            @if($canCalculateShipping)
                                <button type="submit" class="w-full bg-[#022c22] text-[#bef264] py-4 rounded-xl font-bold hover:bg-[#033a2d] transition-all shadow-lg hover:shadow-xl active:scale-95">
                                    Buat Pesanan
                                </button>
                            @else
                                <button type="button" disabled class="w-full bg-gray-200 text-gray-400 py-4 rounded-xl font-bold cursor-not-allowed">
                                    Alamat Tidak Lengkap
                                </button>
                                <p class="text-[10px] text-center mt-2 text-gray-400">Silakan update profil untuk menghitung ongkir.</p>
                            @endif
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
