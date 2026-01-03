@php
    $role = auth()->user()->peran;
    $menus = [
        'petani' => [
            ['name' => 'Dashboard', 'icon' => 'home', 'active' => request()->routeIs('dashboard'), 'route' => route('dashboard')],
            ['name' => 'Stok Saya', 'icon' => 'box', 'active' => request()->routeIs('buah.*'), 'route' => route('buah.index')],
            ['name' => 'Postingan Saya', 'icon' => 'megaphone', 'active' => request()->routeIs('postingan.*'), 'route' => route('postingan.index')],
            ['name' => 'Pesanan Masuk', 'icon' => 'cart', 'active' => request()->routeIs('transaksi.sales'), 'route' => route('transaksi.sales')],
            ['name' => 'Pesan & Diskusi', 'icon' => 'chat', 'active' => request()->routeIs('chat.*'), 'route' => route('chat.index')],
        ],
        'mitra' => [
            ['name' => 'Dashboard', 'icon' => 'home', 'active' => request()->routeIs('dashboard'), 'route' => route('dashboard')],
            ['name' => 'Permintaan Saya', 'icon' => 'list', 'active' => request()->routeIs('permintaan-mitra.*'), 'route' => route('permintaan-mitra.index')],
            ['name' => 'Pesan & Diskusi', 'icon' => 'chat', 'active' => request()->routeIs('chat.*'), 'route' => route('chat.index')],
            ['name' => 'Riwayat Pesanan', 'icon' => 'history', 'active' => request()->routeIs('transaksi.index'), 'route' => route('transaksi.index')],
        ],
        'admin' => [
            ['name' => 'Overview', 'icon' => 'home', 'active' => request()->routeIs('dashboard'), 'route' => route('dashboard')],
            ['name' => 'Management Petani', 'icon' => 'user-check', 'active' => request()->routeIs('admin.petani.*'), 'route' => route('admin.petani.index')],
            ['name' => 'Management Mitra', 'icon' => 'users', 'active' => request()->routeIs('admin.mitra.*'), 'route' => route('admin.mitra.index')],
            ['name' => 'Laporan Transaksi', 'icon' => 'file', 'active' => request()->routeIs('admin.transaksi.*'), 'route' => route('admin.transaksi.index')],
            ['name' => 'Laporan Pengiriman', 'icon' => 'truck', 'active' => request()->routeIs('admin.pengiriman.*'), 'route' => route('admin.pengiriman.index')],

        ],
    ];

    $currentMenus = $menus[$role] ?? [];
@endphp

<aside class="w-64 bg-white h-screen fixed left-0 top-0 border-r border-gray-100 flex flex-col z-50">
    <div class="p-8 flex items-center gap-3">
        <div class="w-8 h-8 bg-[#022c22] rounded-lg flex items-center justify-center text-[#bef264] font-bold">
            N
        </div>
        <span class="font-bold text-xl tracking-tight">Nowaits</span>
    </div>

    <nav class="flex-1 px-4 space-y-2">
        <p class="px-4 text-xs font-bold text-gray-400 uppercase tracking-wider mb-4">
            Menu ({{ $role }})
        </p>
        @foreach($currentMenus as $item)
            @php
                // Check active state
                 $isActive = isset($item['route']) ? request()->url() === $item['route'] || (request()->routeIs('buah.*') && $item['name'] === 'Stok Saya') : $item['active'];

                 // If it's a real route, make it a link, otherwise a button/span
                 $tag = isset($item['route']) ? 'a' : 'button';
            @endphp
            <{{ $tag }} @if(isset($item['route'])) href="{{ $item['route'] }}" @endif
                class="w-full flex items-center gap-3 px-4 py-3 rounded-xl transition-all {{ $isActive ? 'bg-[#022c22] text-white shadow-lg shadow-[#022c22]/20' : 'text-gray-500 hover:bg-gray-50 hover:text-gray-900' }}"
            >
                <span class="opacity-70">
                    @if($item['icon'] === 'home')
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
                    @elseif($item['icon'] === 'box')
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path><polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline><line x1="12" y1="22.08" x2="12" y2="12"></line></svg>
                    @elseif($item['icon'] === 'cart')
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="9" cy="21" r="1"></circle><circle cx="20" cy="21" r="1"></circle><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path></svg>
                     @elseif($item['icon'] === 'search')
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                    @elseif($item['icon'] === 'users')
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
                    @elseif($item['icon'] === 'megaphone')
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 20h9"></path><path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"></path></svg>
                    @elseif($item['icon'] === 'user-check')
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="8.5" cy="7" r="4"></circle><polyline points="17 11 19 13 23 9"></polyline></svg>
                    @elseif($item['icon'] === 'truck')
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="1" y="3" width="15" height="13"></rect><polygon points="16 8 20 8 23 11 23 16 16 16 16 8"></polygon><circle cx="5.5" cy="18.5" r="2.5"></circle><circle cx="18.5" cy="18.5" r="2.5"></circle></svg>
                    @elseif($item['icon'] === 'chat')
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path></svg>
                    @elseif($item['icon'] === 'list')
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="8" y1="6" x2="21" y2="6"></line><line x1="8" y1="12" x2="21" y2="12"></line><line x1="8" y1="18" x2="21" y2="18"></line><line x1="3" y1="6" x2="3.01" y2="6"></line><line x1="3" y1="12" x2="3.01" y2="12"></line><line x1="3" y1="18" x2="3.01" y2="18"></line></svg>
                    @elseif($item['icon'] === 'history')
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 3v5h5"></path><path d="M3.05 13A9 9 0 1 0 6 5.3L3 8"></path></svg>
                    @elseif(in_array($item['icon'], ['chart', 'check', 'file', 'settings']))
                         <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect></svg>
                    @endif
                </span>
                <span class="font-semibold text-sm">{{ $item['name'] }}</span>
            </{{ $tag }}>
        @endforeach
    </nav>

    <div class="p-4 border-t border-gray-100 bg-gray-50 flex flex-col gap-2">
        <a href="{{ route('home') }}" class="w-full flex items-center justify-center gap-2 py-2 text-xs font-bold text-gray-500 border border-gray-200 rounded-lg hover:bg-white hover:text-[#022c22] transition-colors">
            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>
            Back to Home
        </a>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="w-full flex items-center justify-center gap-2 py-2 text-xs font-bold text-red-500 border border-red-200 rounded-lg hover:bg-red-50 transition-colors">
                Logout
            </button>
        </form>
    </div>
</aside>
