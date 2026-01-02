<x-dashboard-layout>
    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">

        <!-- Welcome banner -->
        <div class="relative bg-white p-4 sm:p-6 rounded-2xl overflow-hidden mb-8 shadow-sm border border-gray-100">
            <div class="relative z-10">
                <h1 class="text-2xl md:text-3xl font-bold text-gray-800 mb-1">Management Mitra</h1>
                <p class="text-gray-500">Kelola data mitra (pembeli) yang terdaftar di Nowaits.</p>
            </div>
             <div class="absolute right-0 top-0 h-full w-1/3 bg-gradient-to-l from-[#bef264]/20 to-transparent pointer-events-none"></div>
        </div>

        <div class="bg-white border border-gray-100 rounded-2xl shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="table-auto w-full text-left">
                    <thead class="bg-gray-50 text-gray-500 font-bold uppercase text-xs">
                        <tr>
                            <th class="px-6 py-4">Nama</th>
                            <th class="px-6 py-4">Email</th>
                            <th class="px-6 py-4">No Telepon</th>
                            <th class="px-6 py-4">Lokasi (Kota)</th>
                            <th class="px-6 py-4">Bergabung</th>
                            <th class="px-6 py-4 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 text-sm">
                        @foreach($mitras as $mitra)
                            <tr class="hover:bg-gray-50/50 transition-colors">
                                <td class="px-6 py-4 font-bold text-gray-900">{{ $mitra->name }}</td>
                                <td class="px-6 py-4 text-gray-600">{{ $mitra->email }}</td>
                                <td class="px-6 py-4 text-gray-600">{{ $mitra->no_telepon ?? '-' }}</td>
                                <td class="px-6 py-4 text-gray-600">
                                    {{ Str::limit($mitra->alamatPengguna->alamat_lengkap ?? '-', 30) }}
                                </td>
                                <td class="px-6 py-4 text-gray-500">
                                    {{ $mitra->created_at->format('d M Y') }}
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <button class="bg-gray-100 hover:bg-gray-200 text-gray-600 px-3 py-1 rounded text-xs font-bold transition-colors">
                                        Detail
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
             <div class="px-6 py-4 border-t border-gray-100">
                {{ $mitras->links() }}
            </div>
        </div>

    </div>
</x-dashboard-layout>
