@extends('layouts.landing')

@section('title', 'My Profile')

@section('content')
    {{-- Navbar --}}
    @include('components.home.navbar')

    @push('styles')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>
    <style>
        #map { height: 300px; width: 100%; border-radius: 0.75rem; z-index: 0; }
        .leaflet-container { z-index: 0; }
    </style>
    @endpush

    <div class="min-h-screen pt-12 pb-24 px-6 md:px-12 max-w-7xl mx-auto">
        <div class="max-w-4xl mx-auto">
            <h1 class="text-4xl font-bold mb-2 font-sans tracking-tight">My Profile</h1>
            <p class="text-gray-400 mb-10">Manage your contact information and shipping address.</p>

            <div class="bg-white/5 border border-white/10 rounded-[30px] p-8 md:p-12 shadow-2xl backdrop-blur-sm">
                
                {{-- User Avatar & Basic Info --}}
                <div class="flex items-center gap-6 mb-12 border-b border-white/10 pb-10">
                    <div class="w-24 h-24 rounded-full bg-[#bef264] flex items-center justify-center text-[#022c22] text-3xl font-bold shadow-[0_0_20px_rgba(190,242,100,0.3)]">
                        {{ substr($user->name, 0, 1) }}
                    </div>
                    <div>
                        <h2 class="text-2xl font-bold">{{ $user->name }}</h2>
                        <div class="flex items-center gap-3 mt-1 text-gray-400">
                            <span>{{ $user->email }}</span>
                            <span class="w-1.5 h-1.5 rounded-full bg-gray-600"></span>
                            <span class="uppercase text-xs font-bold tracking-wider px-2 py-0.5 rounded bg-[#bef264]/20 text-[#bef264]">
                                {{ $user->peran }}
                            </span>
                        </div>
                    </div>
                </div>

                <form action="{{ route('profile.update') }}" method="POST" class="space-y-10">
                    @csrf
                    
                    {{-- Contact Information --}}
                    <div>
                        <h3 class="text-xl font-bold mb-6 text-white flex items-center gap-2">
                            <svg class="w-5 h-5 text-[#bef264]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                            Contact Details
                        </h3>
                        <div class="grid md:grid-cols-2 gap-6">
                            <div class="space-y-2">
                                <label class="text-sm font-medium text-gray-400">Phone Number</label>
                                <input type="text" name="no_telepon" value="{{ old('no_telepon', $user->no_telepon) }}" 
                                    placeholder="e.g. 08123456789"
                                    class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-white focus:outline-none focus:border-[#bef264] focus:ring-1 focus:ring-[#bef264] transition">
                            </div>
                        </div>
                    </div>

                    @if($user->peran === 'petani')
                    {{-- Bank Information --}}
                    <div>
                        <h3 class="text-xl font-bold mb-6 text-white flex items-center gap-2">
                            <svg class="w-5 h-5 text-[#bef264]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path></svg>
                            Bank Details
                        </h3>
                        <div class="grid md:grid-cols-2 gap-6">
                            <div class="space-y-2">
                                <label class="text-sm font-medium text-gray-400">Bank Name</label>
                                <input type="text" name="nama_bank" value="{{ old('nama_bank', $alamat?->nama_bank) }}" 
                                    placeholder="e.g. BCA, BRI, Mandiri"
                                    class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-white focus:outline-none focus:border-[#bef264] focus:ring-1 focus:ring-[#bef264] transition">
                            </div>
                            <div class="space-y-2">
                                <label class="text-sm font-medium text-gray-400">Account Number</label>
                                <input type="text" name="no_rekening" value="{{ old('no_rekening', $alamat?->no_rekening) }}" 
                                    placeholder="e.g. 1234567890"
                                    class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-white focus:outline-none focus:border-[#bef264] focus:ring-1 focus:ring-[#bef264] transition">
                            </div>
                        </div>
                    </div>
                    @endif

                    {{-- Address Information --}}
                    <div>
                        <h3 class="text-xl font-bold mb-6 text-white flex items-center gap-2">
                            <svg class="w-5 h-5 text-[#bef264]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                            Primary Address
                        </h3>

                        {{-- Leaflet Map --}}
                        <div id="map" class="mb-6 border border-white/10"></div>
                        <p class="text-xs text-gray-400 mb-6 italic">* Click on the map to set your location automatically</p>

                        <div class="grid md:grid-cols-2 gap-6 mb-6">
                            <div class="space-y-2">
                                <label class="text-sm font-medium text-gray-400">Address Label</label>
                                <input type="text" name="label_alamat" value="{{ old('label_alamat', $alamat?->label_alamat) }}"
                                    placeholder="e.g. Home, Office, Warehouse"
                                    class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-white focus:outline-none focus:border-[#bef264] focus:ring-1 focus:ring-[#bef264] transition">
                            </div>
                            <div class="space-y-2">
                                <label class="text-sm font-medium text-gray-400">Coordinates</label>
                                <div class="flex gap-2">
                                    <input type="text" id="latitude" name="latitude" value="{{ old('latitude', $alamat?->latitude) }}" placeholder="Lat" class="w-1/2 bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-white text-sm focus:outline-none focus:border-[#bef264] transition" readonly>
                                    <input type="text" id="longitude" name="longitude" value="{{ old('longitude', $alamat?->longitude) }}" placeholder="Long" class="w-1/2 bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-white text-sm focus:outline-none focus:border-[#bef264] transition" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="space-y-2">
                            <label class="text-sm font-medium text-gray-400">Full Address</label>
                            <textarea id="alamat_lengkap" name="alamat_lengkap" rows="3" 
                                placeholder="Start typing your complete address..."
                                class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-white focus:outline-none focus:border-[#bef264] focus:ring-1 focus:ring-[#bef264] transition">{{ old('alamat_lengkap', $alamat?->alamat_lengkap) }}</textarea>
                        </div>
                    </div>

                    <div class="pt-6 border-t border-white/10 flex justify-end">
                        <button type="submit" class="bg-[#bef264] text-[#022c22] font-bold px-8 py-3 rounded-full hover:bg-[#a3d945] transition transform hover:scale-105 shadow-lg shadow-[#bef264]/20">
                            Save Changes
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('scripts')
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Default Lat/Long (Indonesia) or User's Saved Location
            var savedLat = {{ $alamat?->latitude ?? -6.200000 }}; 
            var savedLng = {{ $alamat?->longitude ?? 106.816666 }};
            var zoomLevel = {{ $alamat?->latitude ? 13 : 5 }};

            var map = L.map('map').setView([savedLat, savedLng], zoomLevel);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19,
                attribution: '© OpenStreetMap'
            }).addTo(map);

            var marker;

            // If saved location exists, show marker
            @if($alamat?->latitude)
                marker = L.marker([savedLat, savedLng]).addTo(map);
            @endif

            map.on('click', function(e) {
                var lat = e.latlng.lat;
                var lng = e.latlng.lng;

                // Update Inputs
                document.getElementById('latitude').value = lat;
                document.getElementById('longitude').value = lng;

                // Remove old marker
                if (marker) {
                    map.removeLayer(marker);
                }

                // Add new marker
                marker = L.marker([lat, lng]).addTo(map);

                // Reverse Geocode (Nominatim)
                fetch(`https://nominatim.openstreetmap.org/reverse?format=jsonv2&lat=${lat}&lon=${lng}`)
                    .then(response => response.json())
                    .then(data => {
                        if (data.display_name) {
                            document.getElementById('alamat_lengkap').value = data.display_name;
                        }
                    })
                    .catch(error => {
                        console.error('Error fetching address:', error);
                        Swal.fire({
                            icon: 'info',
                            title: 'Address Info',
                            text: 'Could not fetch address description automatically. Please fill manually.',
                        });
                    });
            });
        });
    </script>
    @endpush
@endsection
