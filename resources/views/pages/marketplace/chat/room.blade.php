<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat dengan {{ $opponent->name }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 h-screen flex flex-col font-sans" 
      x-data="chatRoom('{{ $conversation->id }}', '{{ $currentUser->id_pengguna }}')">

    <header class="bg-white shadow-sm px-4 py-3 flex items-center fixed top-0 w-full z-10">
        <a href="{{ $backUrl }}" class="mr-4 text-gray-600 hover:text-gray-900">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
            </svg>
        </a>

        <div class="flex items-center gap-3">
            <div class="relative">
                <img class="w-10 h-10 rounded-full object-cover border border-gray-200" 
                     src="https://ui-avatars.com/api/?name={{ urlencode($opponent->name) }}&background=0D9488&color=fff" 
                     alt="Profile">
                <span class="absolute bottom-0 right-0 w-3 h-3 bg-green-500 border-2 border-white rounded-full"></span>
            </div>
            <div>
                <h1 class="font-bold text-gray-800 text-sm md:text-base">{{ $opponent->name }}</h1>
                <p class="text-xs text-green-600 font-medium capitalize">{{ $opponent->peran }}</p>
            </div>
        </div>
    </header>

    <main class="flex-1 overflow-y-auto p-4 pt-20 pb-24" x-ref="chatBox">
        <template x-for="msg in messages" :key="msg.id">
            <div class="flex w-full mb-4" 
                 :class="msg.sender_id == myId ? 'justify-end' : 'justify-start'">
                
                <div class="max-w-[75%] md:max-w-[60%] px-4 py-2 rounded-2xl shadow-sm relative text-sm"
                     :class="msg.sender_id == myId 
                        ? 'bg-green-700 text-white rounded-tr-none' 
                        : 'bg-white text-gray-800 rounded-tl-none border border-gray-100'">
                    
                    <p x-text="msg.body" class="leading-relaxed"></p>
                    
                    <div class="text-[10px] mt-1 text-right opacity-70"
                         x-text="formatTime(msg.created_at)">
                    </div>
                </div>
            </div>
        </template>
        
        <div x-show="isLoading" class="flex justify-center mt-4">
            <span class="text-xs text-gray-400">Memuat percakapan...</span>
        </div>
    </main>

    <footer class="bg-white border-t p-4 fixed bottom-0 w-full">
        <form @submit.prevent="sendMessage" class="flex items-center gap-2 max-w-4xl mx-auto">
            <input type="text" x-model="newMessage" 
                   class="flex-1 bg-gray-100 border-0 rounded-full px-5 py-3 focus:ring-2 focus:ring-green-500 focus:bg-white transition text-sm"
                   placeholder="Tulis pesan ke {{ $opponent->name }}..."
                   required>
            
            <button type="submit" 
                    class="bg-green-800 hover:bg-green-900 text-white p-3 rounded-full shadow-lg transition transform active:scale-95 flex items-center justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5">
                    <path d="M3.478 2.405a.75.75 0 00-.926.94l2.432 7.905H13.5a.75.75 0 010 1.5H4.984l-2.432 7.905a.75.75 0 00.926.94 60.519 60.519 0 0018.445-8.986.75.75 0 000-1.218A60.517 60.517 0 003.478 2.405z" />
                </svg>
            </button>
        </form>
    </footer>

    <script>
        function chatRoom(conversationId, myUserId) {
            return {
                messages: [],
                newMessage: '',
                conversationId: conversationId,
                myId: myUserId,
                isLoading: true,

                init() {
                    // 1. Ambil Pesan Lama
                    axios.get(`/chat/${this.conversationId}/messages`)
                        .then(res => {
                            this.messages = res.data;
                            this.isLoading = false;
                            this.scrollToBottom();
                        });

                    // 2. Setup Realtime Listener
                    // Pastikan di bootstrap.js kamu sudah setup window.Echo
                    if (window.Echo) {
                        window.Echo.private(`chat.${this.conversationId}`)
                            .listen('MessageSent', (e) => {
                                this.messages.push(e.message);
                                this.scrollToBottom();
                            });
                    }
                },

                sendMessage() {
                    if (!this.newMessage.trim()) return;
                    
                    let body = this.newMessage;
                    this.newMessage = ''; // Reset input dulu biar responsif

                    axios.post(`/chat/${this.conversationId}/send`, { message: body })
                        .then(res => {
                            this.messages.push(res.data);
                            this.scrollToBottom();
                        })
                        .catch(err => console.error(err));
                },

                scrollToBottom() {
                    this.$nextTick(() => {
                        const box = this.$refs.chatBox;
                        box.scrollTop = box.scrollHeight;
                    });
                },
                
                formatTime(dateString) {
                    const date = new Date(dateString);
                    return date.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });
                }
            }
        }
    </script>
</body>
</html>