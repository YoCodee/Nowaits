<x-dashboard-layout>
    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-4xl mx-auto">
        <div class="mb-6 flex items-center justify-between">
            <h1 class="text-2xl font-bold text-gray-800">Lacak Pesanan</h1>
            <a href="{{ auth()->user()->peran == 'mitra' ? route('transaksi.index') : route('transaksi.sales') }}" class="text-sm font-bold text-gray-500 hover:text-[#022c22]">
                &larr; Kembali
            </a>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <!-- Timeline Header -->
            <div class="p-6 border-b border-gray-100 bg-gray-50">
                <div class="flex items-center justify-between mb-4">
                    <div>
                        <h2 class="font-bold text-gray-900 text-lg">No. Resi: {{ $transaksi->pengiriman->no_resi ?? 'Belum ada resi' }}</h2>
                        <p class="text-sm text-gray-500">{{ $transaksi->pengiriman->ekspedisi ?? 'Ekspedisi belum dipilih' }}</p>
                    </div>
                     <span class="px-3 py-1 rounded-full text-xs font-bold bg-blue-100 text-blue-700 uppercase">
                        {{ str_replace('_', ' ', $transaksi->status) }}
                    </span>
                </div>

                <!-- Simple Status Timeline -->
                <div class="relative flex items-center justify-between w-full max-w-lg mx-auto mt-8">
                     <!-- Line Background -->
                    <div class="absolute top-1/2 left-0 w-full h-1 bg-gray-200 -z-0"></div>
                     <!-- Progress Line -->
                    <div class="absolute top-1/2 left-0 h-1 bg-[#022c22] -z-0 transition-all duration-500"
                        style="width: {{ 
                            $transaksi->status == 'menunggu_pembayaran' ? '0%' : 
                            ($transaksi->status == 'menunggu_konfirmasi' ? '25%' : 
                            ($transaksi->status == 'diproses' ? '50%' : 
                            ($transaksi->status == 'dikirim' ? '75%' : 
                            ($transaksi->status == 'selesai' ? '100%' : '0%')))) 
                        }}"></div>

                    <!-- Steps -->
                    <div class="relative z-10 bg-white w-8 h-8 rounded-full border-2 {{ in_array($transaksi->status, ['menunggu_pembayaran', 'menunggu_konfirmasi', 'diproses', 'dikirim', 'selesai']) ? 'border-[#022c22] bg-[#022c22] text-white' : 'border-gray-300' }} flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path><line x1="3" y1="6" x2="21" y2="6"></line><path d="M16 10a4 4 0 0 1-8 0"></path></svg>
                    </div>
                    <div class="relative z-10 bg-white w-8 h-8 rounded-full border-2 {{ in_array($transaksi->status, ['diproses', 'dikirim', 'selesai']) ? 'border-[#022c22] bg-[#022c22] text-white' : 'border-gray-300' }} flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg>
                    </div>
                     <div class="relative z-10 bg-white w-10 h-10 rounded-full border-2 {{ in_array($transaksi->status, ['dikirim', 'selesai']) ? 'border-[#022c22] bg-[#022c22] text-white' : 'border-gray-300' }} flex items-center justify-center shadow-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="1" y="3" width="15" height="13"></rect><polygon points="16 8 20 8 23 11 23 16 16 16 16 8"></polygon><circle cx="5.5" cy="18.5" r="2.5"></circle><circle cx="18.5" cy="18.5" r="2.5"></circle></svg>
                    </div>
                     <div class="relative z-10 bg-white w-8 h-8 rounded-full border-2 {{ $transaksi->status == 'selesai' ? 'border-[#022c22] bg-[#022c22] text-white' : 'border-gray-300' }} flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>
                    </div>
                </div>
                 <div class="flex justify-between w-full max-w-lg mx-auto mt-2 text-xs font-bold text-gray-500">
                    <span>Bayar</span>
                    <span>Proses</span>
                    <span>Dikirim</span>
                    <span>Selesai</span>
                </div>
            </div>

            <!-- Map Area -->
            <div id="map" class="w-full h-[400px] z-0"></div>

            <div class="p-6">
                <h3 class="font-bold text-gray-800 mb-2">Riwayat Pengiriman</h3>
                 <div class="space-y-4 border-l-2 border-gray-200 ml-2 pl-4">
                    @if($transaksi->status == 'selesai')
                        <div class="relative">
                             <div class="absolute -left-[21px] top-1 w-3 h-3 bg-green-500 rounded-full border-2 border-white"></div>
                            <p class="text-sm font-bold text-green-700">Pesanan Diterima</p>
                             <p class="text-xs text-gray-500">{{ $transaksi->updated_at->format('d M Y H:i') }}</p>
                        </div>
                    @endif
                     @if(in_array($transaksi->status, ['dikirim', 'selesai']))
                        <div class="relative">
                             <div class="absolute -left-[21px] top-1 w-3 h-3 bg-blue-500 rounded-full border-2 border-white"></div>
                            <p class="text-sm font-bold text-gray-800">Paket Sedang Dikirim</p>
                             <p class="text-xs text-gray-500">{{ $transaksi->pengiriman->created_at->format('d M Y H:i') ?? '-' }} - Menuju lokasi penerima</p>
                        </div>
                    @endif
                     @if(in_array($transaksi->status, ['diproses', 'dikirim', 'selesai']))
                        <div class="relative">
                            <div class="absolute -left-[21px] top-1 w-3 h-3 bg-gray-300 rounded-full border-2 border-white"></div>
                            <p class="text-sm font-bold text-gray-600">Pesanan Diproses Penjual</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Leaflet CSS & JS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var sellerLat = {{ $sellerLat }};
            var sellerLng = {{ $sellerLng }};
            var buyerLat = {{ $buyerLat }};
            var buyerLng = {{ $buyerLng }};

            // Initialize Map
            var map = L.map('map').setView([sellerLat, sellerLng], 10);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            }).addTo(map);

            // Custom Icons
            var sellerIcon = L.icon({
                iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/markers/marker-icon-orange.png',
                iconSize: [25, 41],
                iconAnchor: [12, 41],
                popupAnchor: [1, -34],
                shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
                shadowSize: [41, 41]
            });

             var buyerIcon = L.icon({
                iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/markers/marker-icon-green.png',
                iconSize: [25, 41],
                iconAnchor: [12, 41],
                popupAnchor: [1, -34],
                shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
                shadowSize: [41, 41]
            });

            // Add Markers
            var sellerMarker = L.marker([sellerLat, sellerLng], {icon: sellerIcon}).addTo(map)
                .bindPopup('<b>Lokasi Petani</b><br>Pengirim');
            
            var buyerMarker = L.marker([buyerLat, buyerLng], {icon: buyerIcon}).addTo(map)
                .bindPopup('<b>Lokasi Anda</b><br>Penerima');

            // Draw Dashed Line
            var latlngs = [
                [sellerLat, sellerLng],
                [buyerLat, buyerLng]
            ];
            var polyline = L.polyline(latlngs, {color: '#022c22', dashArray: '10, 10', weight: 3}).addTo(map);

            // Fit Bounds
            map.fitBounds(polyline.getBounds(), {padding: [50, 50]});
        });
    </script>
</x-dashboard-layout>
