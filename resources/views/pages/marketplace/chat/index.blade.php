<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kotak Masuk</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 font-sans">

    <div class=" mx-auto min-h-screen bg-white shadow-sm">
        <div class="px-6 py-4 border-b flex justify-between items-center sticky top-0 bg-white z-10">
            <h1 class="text-xl font-bold text-gray-800">Pesan</h1>
            <a href="/dashboard" class="text-sm text-gray-500 hover:text-green-600">Kembali ke Dashboard</a>
        </div>

        <div class="divide-y divide-gray-100">
            @forelse($conversations as $chat)
                @php
                    // Logika menentukan lawan bicara di dalam loop
                    $partner = ($chat->user_one_id == $userId) ? $chat->userTwo : $chat->userOne;
                    $lastMsg = $chat->lastMessage;
                @endphp

                <a href="{{ route('chat.show', $chat->id) }}" class="block hover:bg-gray-50 transition p-4">
                    <div class="flex items-center gap-4">
                        <img class="w-12 h-12 rounded-full object-cover border" 
                             src="https://ui-avatars.com/api/?name={{ urlencode($partner->name) }}&background=random" 
                             alt="{{ $partner->name }}">
                        
                        <div class="flex-1 min-w-0">
                            <div class="flex justify-between items-baseline mb-1">
                                <h2 class="text-base font-semibold text-gray-900 truncate">
                                    {{ $partner->name }}
                                </h2>
                                <span class="text-xs text-gray-400">
                                    {{ $lastMsg ? $lastMsg->created_at->diffForHumans() : '' }}
                                </span>
                            </div>
                            
                            <p class="text-sm text-gray-600 truncate flex items-center gap-1">
                                @if($lastMsg && $lastMsg->sender_id == $userId)
                                    <span class="text-gray-400">Anda:</span>
                                @endif
                                
                                {{ $lastMsg ? $lastMsg->body : 'Belum ada pesan' }}
                            </p>
                            
                            @if($chat->posting)
                            <div class="mt-2 inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-green-100 text-green-800">
                                Produk: {{ $chat->posting->judul_posting }}
                            </div>
                            @endif
                        </div>
                    </div>
                </a>
            @empty
                <div class="p-10 text-center text-gray-500">
                    <p class="mb-2">Belum ada percakapan.</p>
                    <a href="/" class="text-green-600 hover:underline">Cari produk di Market</a>
                </div>
            @endforelse
        </div>
    </div>

</body>
</html>