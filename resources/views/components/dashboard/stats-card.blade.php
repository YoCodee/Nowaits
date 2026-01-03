@props(['title', 'value', 'subtext', 'trend' => null])

<div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm hover:shadow-md transition-all">
    <div class="flex items-start justify-between mb-4">
        <div class="p-3 bg-gray-50 rounded-xl text-[#022c22]">
            {{ $icon }}
        </div>
        @if($trend)
            <span
                class="text-xs font-bold px-2 py-1 rounded-full {{ $trend > 0 ? 'bg-green-50 text-green-600' : 'bg-red-50 text-red-600' }}"
            >
                {{ $trend > 0 ? '+' : '' }}{{ $trend }}%
            </span>
        @endif
    </div>
    <h3 class="text-gray-500 text-sm font-medium mb-1">{{ $title }}</h3>
    <p class="text-2xl font-bold text-[#022c22] mb-1">{{ $value }}</p>
    <p class="text-xs text-gray-400">{{ $subtext }}</p>
</div>
