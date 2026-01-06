<x-dashboard-layout>
    @php $role = auth()->user()->peran; @endphp

    @if($role === 'petani')
        {{-- Existing Petani Dashboard --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">

            <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm relative overflow-hidden group hover:shadow-md transition-all">
                <div class="flex justify-between items-start mb-4">
                    <div class="p-3 bg-green-50 rounded-xl text-green-600 group-hover:scale-110 transition-transform">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="1" x2="12" y2="23"></line><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path></svg>
                    </div>
                </div>
                <div>
                    <p class="text-sm font-bold text-gray-500 mb-1">Total Pendapatan</p>
                    <h3 class="text-2xl font-bold text-[#022c22] mb-1">Rp {{ number_format($pendapatanBersih, 0, ',', '.') }}</h3>
                    <p class="text-xs text-gray-400">Bersih (Tanpa Ongkir)</p>
                    
                    <div class="mt-3 pt-3 border-t border-gray-100 flex justify-between items-center bg-gray-50/50 p-2 rounded-lg">
                        <span class="text-xs text-gray-500 font-medium">Kotor (Total Masuk)</span>
                        <span class="text-xs font-bold text-gray-700">Rp {{ number_format($pendapatanKotor, 0, ',', '.') }}</span>
                    </div>
                </div>
            </div>
            <x-dashboard.stats-card title="Buah Terjual" value="{{ number_format($buahTerjual, 0, ',', '.') }} kg" subtext="Total terjual via Marketplace">
                <x-slot name="icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path><line x1="3" y1="6" x2="21" y2="6"></line><path d="M16 10a4 4 0 0 1-8 0"></path></svg>
                </x-slot>
            </x-dashboard.stats-card>
            <x-dashboard.stats-card title="Stok Tersedia" value="{{ number_format($stok, 0, ',', '.') }} kg" subtext="Siap dipasarkan">
                <x-slot name="icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path><polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline><line x1="12" y1="22.08" x2="12" y2="12"></line></svg>
                </x-slot>
            </x-dashboard.stats-card>
        </div>
        <div class="bg-white rounded-2xl border border-gray-100 p-6">
            <h3 class="font-bold text-lg mb-4 text-[#022c22]">Pesanan Terbaru</h3>
            <div class="overflow-x-auto">
                {{-- (Table content same as original, shortened for brevity in update) --}}
                <table class="w-full text-left text-sm">
                    <thead>
                        <tr class="text-gray-400 border-b border-gray-100">
                            <th class="pb-3 font-medium">Order ID</th>
                            <th class="pb-3 font-medium">Pembeli</th>
                            <th class="pb-3 font-medium">Produk</th>
                            <th class="pb-3 font-medium">Total</th>
                            <th class="pb-3 font-medium">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        @forelse($pesananTerbaru as $order)
                            <tr class="group hover:bg-gray-50 transition-colors">
                                <td class="py-4 font-bold text-[#022c22]">#{{ substr($order->id_transaksi, 0, 8) }}</td>
                                <td class="py-4">{{ $order->pembeli->name }}</td>
                                <td class="py-4">
                                    @if($order->postingan && $order->postingan->buah)
                                        {{ $order->postingan->buah->nama_buah }} ({{ $order->jumlah_kg }}kg)
                                    @else
                                        Deleted Item ({{ $order->jumlah_kg }}kg)
                                    @endif
                                </td>
                                <td class="py-4 font-bold">Rp {{ number_format($order->total_bayar, 0, ',', '.') }}</td>
                                <td class="py-4">
                                    <span class="bg-green-100 text-green-700 px-2 py-1 rounded-md text-xs font-bold">{{ ucfirst($order->status) }}</span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="py-4 text-center text-gray-500">Belum ada pesanan terbaru.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="mt-4">
                {{ $pesananTerbaru->links() }}
            </div>
        </div>

    @elseif($role === 'mitra')
        {{-- Existing Mitra Dashboard --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <x-dashboard.stats-card title="Total Pengeluaran" value="Rp {{ number_format($totalPembelianRp, 0, ',', '.') }}" subtext="Total belanja anda">
                <x-slot name="icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="23 18 13.5 8.5 8.5 13.5 1 6"></polyline><polyline points="17 6 23 6 23 12"></polyline></svg>
                </x-slot>
            </x-dashboard.stats-card>
            <x-dashboard.stats-card title="Buah Dibeli" value="{{ number_format($totalBuahDibeli, 0, ',', '.') }} kg" subtext="Total bahan baku didapat">
                <x-slot name="icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path><line x1="3" y1="6" x2="21" y2="6"></line><path d="M16 10a4 4 0 0 1-8 0"></path></svg>
                </x-slot>
            </x-dashboard.stats-card>
            <x-dashboard.stats-card title="Request Aktif" value="{{ $requestAktif }} Request" subtext="Menunggu penawaran petani">
                <x-slot name="icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="7 10 12 15 17 10"></polyline><line x1="12" y1="15" x2="12" y2="3"></line></svg>
                </x-slot>
            </x-dashboard.stats-card>
        </div>

        <div class="bg-blue-50 border border-blue-100 rounded-2xl p-6 mb-8 flex items-center justify-between">
            <div>
                <h3 class="text-blue-900 font-bold text-lg mb-1">Stok Apel di Malang sedang melimpah!</h3>
                <p class="text-blue-700 text-sm">Harga turun 15% dari minggu lalu. Waktu yang tepat untuk restock.</p>
            </div>
            <a href="{{ route('marketplace.index') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg text-sm font-bold shadow hover:bg-blue-700">
                Lihat Pasar
            </a>
        </div>

        <h3 class="font-bold text-lg mb-4 text-[#022c22]">Permintaan Anda</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            @forelse($permintaanAnda as $req)
                <div class="bg-white p-5 rounded-2xl border border-gray-100 shadow-sm">
                    <div class="flex justify-between items-start mb-3">
                        <h4 class="font-bold text-gray-800">{{ $req->nama_buah_dicari ?? 'Buah' }} ({{ $req->jumlah_dicari_kg }}kg)</h4>
                        <span class="bg-yellow-100 text-yellow-700 text-xs font-bold px-2 py-1 rounded">{{ $req->status_tawaran }}</span>
                    </div>
                    <p class="text-gray-500 text-sm mb-4">{{ Str::limit($req->deskripsi_tambahan, 50) }}. Budget: Rp {{ number_format($req->harga_ajuan_per_kg, 0, ',', '.') }}/kg</p>
                    <a href="{{ route('permintaan-mitra.show', $req->id_permintaan) }}" class="block w-full text-center py-2 text-sm border border-gray-200 rounded-lg font-bold text-gray-600 hover:bg-gray-50">
                        Lihat Penawaran
                    </a>
                </div>
            @empty
                <div class="col-span-2 text-center py-6 text-gray-500 bg-white rounded-2xl border border-gray-100">
                    Anda belum membuat permintaan.
                </div>
            @endforelse
        </div>

        <div class="bg-white rounded-2xl border border-gray-100 p-6 mt-8">
            <h3 class="font-bold text-lg mb-4 text-[#022c22]">Riwayat Pesanan</h3>
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm">
                    <thead>
                        <tr class="text-gray-400 border-b border-gray-100">
                            <th class="pb-3 font-medium">Order ID</th>
                            <th class="pb-3 font-medium">Penjual</th>
                            <th class="pb-3 font-medium">Produk</th>
                            <th class="pb-3 font-medium">Total</th>
                            <th class="pb-3 font-medium">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        @forelse($pesananTerbaru as $order)
                            <tr class="group hover:bg-gray-50 transition-colors">
                                <td class="py-4 font-bold text-[#022c22]">#{{ substr($order->id_transaksi, 0, 8) }}</td>
                                <td class="py-4">{{ $order->penjual->name ?? 'Petani' }}</td>
                                <td class="py-4">
                                    @if($order->postingan && $order->postingan->buah)
                                        {{ $order->postingan->buah->nama_buah }} ({{ $order->jumlah_kg }}kg)
                                    @else
                                        Deleted Item ({{ $order->jumlah_kg }}kg)
                                    @endif
                                </td>
                                <td class="py-4 font-bold">Rp {{ number_format($order->total_bayar, 0, ',', '.') }}</td>
                                <td class="py-4">
                                    <span class="bg-green-100 text-green-700 px-2 py-1 rounded-md text-xs font-bold">{{ ucfirst($order->status) }}</span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="py-4 text-center text-gray-500">Belum ada riwayat pesanan.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="mt-4">
                {{ $pesananTerbaru->links() }}
            </div>
        </div>

    @elseif($role === 'admin')
        {{-- ADMIN DASHBOARD START --}}
        <!-- SDG Tracker / Overview -->
        <h3 class="font-bold text-xl mb-4 text-[#022c22]">SDG Tracker & Overview</h3>
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            <!-- 1. WASTE SAVED -->
            <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm relative overflow-hidden">
                <div class="relative z-10">
                    <p class="text-sm font-medium text-gray-500 mb-1">Waste Terselamatkan</p>
                    <h3 class="text-2xl font-bold text-[#022c22]">{{ number_format($wasteSavedKg, 0, ',', '.') }} Kg</h3>
                    <div class="flex items-center gap-1 mt-2 text-xs font-bold text-green-600 bg-green-50 w-fit px-2 py-1 rounded-lg">
                        <span>Buah Tidak Terbuang</span>
                    </div>
                </div>
                <!-- Decor -->
                 <div class="absolute -right-4 -bottom-4 text-green-100">
                    <svg xmlns="http://www.w3.org/2000/svg" width="80" height="80" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2c-5.52 0-10 4.48-10 10s4.48 10 10 10 10-4.48 10-10-4.48-10-10-10zm-1 15h-2v-2h2v2zm0-4h-2V7h2v6z"/></svg>
                </div>
            </div>

            <!-- 2. FARMER INCOME HELPED -->
            <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm relative overflow-hidden">
                <div class="relative z-10">
                    <p class="text-sm font-medium text-gray-500 mb-1">Pendapatan Petani</p>
                    <h3 class="text-2xl font-bold text-[#022c22]">Rp {{ number_format($pendapatanPetani, 0, ',', '.') }}</h3>
                    <div class="flex items-center gap-1 mt-2 text-xs font-bold text-blue-600 bg-blue-50 w-fit px-2 py-1 rounded-lg">
                        <span>Ekonomi Sirkular</span>
                    </div>
                </div>
                <div class="absolute -right-4 -bottom-4 text-blue-100">
                    <svg xmlns="http://www.w3.org/2000/svg" width="80" height="80" viewBox="0 0 24 24" fill="currentColor"><path d="M11.8 10.9c-2.27-.59-3-1.2-3-2.15 0-1.09 1.01-1.85 2.7-1.85 1.78 0 2.44.85 2.5 2.1h2.21c-.07-1.72-1.12-3.3-3.21-3.81V3h-3v2.16c-1.94.42-3.5 1.68-3.5 3.61 0 2.31 1.91 3.46 4.7 4.13 2.5.6 3 1.48 3 2.41 0 .69-.49 1.79-2.7 1.79-2.06 0-2.87-.92-2.98-2.1h-2.2c.12 2.19 1.76 3.42 3.68 3.83V21h3v-2.15c1.95-.37 3.5-1.5 3.5-3.55 0-2.84-2.43-3.81-4.7-4.4z"/></svg>
                </div>
            </div>

            <!-- 3. ACTIVE MITRA -->
            <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm relative overflow-hidden">
                <div class="relative z-10">
                    <p class="text-sm font-medium text-gray-500 mb-1">Mitra Aktif</p>
                    <h3 class="text-2xl font-bold text-[#022c22]">{{ $mitraAktif }} User</h3>
                    <div class="flex items-center gap-1 mt-2 text-xs font-bold text-orange-600 bg-orange-50 w-fit px-2 py-1 rounded-lg">
                        <span>Outlet/Pabrik</span>
                    </div>
                </div>
                 <div class="absolute -right-4 -bottom-4 text-orange-100">
                    <svg xmlns="http://www.w3.org/2000/svg" width="80" height="80" viewBox="0 0 24 24" fill="currentColor"><path d="M16 11c1.66 0 2.99-1.34 2.99-3S17.66 5 16 5c-1.66 0-3 1.34-3 3s1.34 3 3 3zm-8 0c1.66 0 2.99-1.34 2.99-3S9.66 5 8 5C6.34 5 5 6.34 5 8s1.34 3 3 3zm0 2c-2.33 0-7 1.17-7 3.5V19h14v-2.5c0-2.33-4.67-3.5-7-3.5zm8 0c-.29 0-.62.02-.97.05 1.16.84 1.97 1.97 1.97 3.45V19h6v-2.5c0-2.33-4.67-3.5-7-3.5z"/></svg>
                </div>
            </div>

            <!-- 4. TOTAL USER -->
            <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm relative overflow-hidden">
                 <div class="relative z-10">
                    <p class="text-sm font-medium text-gray-500 mb-1">Total Pengguna</p>
                    <h3 class="text-2xl font-bold text-[#022c22]">{{ $totalUser }}</h3>
                    <div class="mt-2 text-xs flex gap-2">
                         <span class="text-gray-500">{{ $totalPetani }} Petani</span>
                         <span class="text-gray-300">|</span>
                         <span class="text-gray-500">{{ $totalMitra }} Mitra</span>
                    </div>
                </div>
                 <div class="absolute -right-4 -bottom-4 text-gray-100">
                    <svg xmlns="http://www.w3.org/2000/svg" width="80" height="80" viewBox="0 0 24 24" fill="currentColor"><circle cx="12" cy="12" r="10"/></svg>
                </div>
            </div>
        </div>

        <!-- TREND TERKINI -->
        <h3 class="font-bold text-lg mb-4 text-[#022c22]">Trend Terkini (Transaksi Sukses Terbaru)</h3>
        <div class="bg-white rounded-2xl border border-gray-100 p-6 mb-8 shadow-sm">
             <div class="overflow-x-auto">
                <table class="w-full text-left text-sm">
                    <thead>
                        <tr class="text-gray-400 border-b border-gray-100">
                            <th class="pb-3 font-medium">Buah</th>
                            <th class="pb-3 font-medium">Petani (Asal)</th>
                            <th class="pb-3 font-medium">Terjual Ke</th>
                            <th class="pb-3 font-medium text-right">Volume</th>
                            <th class="pb-3 font-medium text-right">Nilai Transaksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        @forelse($recentTransactions as $tx)
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="py-3 font-bold text-gray-700">{{ $tx->postingan->buah->nama_buah ?? 'Unknown' }}</td>
                                <td class="py-3 text-gray-600">{{ $tx->penjual->name ?? '-' }}</td>
                                <td class="py-3 text-gray-600">{{ $tx->pembeli->name ?? '-' }}</td>
                                <td class="py-3 text-right font-medium">{{ $tx->jumlah_kg }} Kg</td>
                                <td class="py-3 text-right font-bold text-[#022c22]">Rp {{ number_format($tx->total_bayar, 0, ',', '.') }}</td>
                            </tr>
                        @empty
                            <tr><td colspan="5" class="py-4 text-center text-gray-400">Belum ada trend data.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- USER MANAGEMENT SECTIONS -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">

            <!-- PETANI MANAGEMENT -->
            <div>
                 <h3 class="font-bold text-lg mb-4 text-[#022c22]">Management Petani</h3>
                 <div class="bg-white rounded-2xl border border-gray-100 overflow-hidden shadow-sm">
                    <div class="max-h-96 overflow-y-auto">
                        <table class="w-full text-left text-sm">
                            <thead class="bg-gray-50 sticky top-0">
                                <tr class="text-gray-500 font-bold text-xs uppercase">
                                    <th class="px-4 py-3">Nama</th>
                                    <th class="px-4 py-3">Lokasi</th>
                                    <th class="px-4 py-3 text-right">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                @forelse($petaniList as $petani)
                                    <tr>
                                        <td class="px-4 py-3 font-medium">{{ $petani->name }}</td>
                                        <td class="px-4 py-3 text-gray-500">{{ $petani->alamatPengguna->kota ?? '-' }}</td>
                                        <td class="px-4 py-3 text-right">
                                            <button class="text-xs bg-gray-100 px-2 py-1 rounded hover:bg-gray-200">Detail</button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr><td colspan="3" class="px-4 py-4 text-center text-gray-400">Kosong</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                 </div>
            </div>

            <!-- MITRA MANAGEMENT -->
            <div>
                 <h3 class="font-bold text-lg mb-4 text-[#022c22]">Management Mitra</h3>
                 <div class="bg-white rounded-2xl border border-gray-100 overflow-hidden shadow-sm">
                    <div class="max-h-96 overflow-y-auto">
                        <table class="w-full text-left text-sm">
                            <thead class="bg-gray-50 sticky top-0">
                                <tr class="text-gray-500 font-bold text-xs uppercase">
                                    <th class="px-4 py-3">Nama Mitra</th>
                                    <th class="px-4 py-3">Lokasi</th>
                                    <th class="px-4 py-3 text-right">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                @forelse($mitraList as $mitra)
                                    <tr>
                                        <td class="px-4 py-3 font-medium">{{ $mitra->name }}</td>
                                        <td class="px-4 py-3 text-gray-500">{{ $mitra->alamatPengguna->kota ?? '-' }}</td>
                                        <td class="px-4 py-3 text-right">
                                            <button class="text-xs bg-gray-100 px-2 py-1 rounded hover:bg-gray-200">Detail</button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr><td colspan="3" class="px-4 py-4 text-center text-gray-400">Kosong</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                 </div>
            </div>

        </div>

    @endif
</x-dashboard-layout>
