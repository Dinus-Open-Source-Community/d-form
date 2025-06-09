<a
    class="bg-white rounded-2xl shadow-lg overflow-hidden cursor-pointer transition-all duration-300 transform hover:scale-[1.02] hover:shadow-xl hover:-translate-y-1 flex flex-col h-full group border border-gray-200/30 relative"
    href="{{ route('admin.event-detail', $event['id']) }}"
    wire:navigate
>
    <!-- Decorative gradient circles -->
    <div
        class="absolute top-0 right-0 w-16 h-16 bg-gradient-to-br from-primary/10 to-transparent rounded-full -translate-y-8 translate-x-8 pointer-events-none">
    </div>
    <div
        class="absolute bottom-0 left-0 w-12 h-12 bg-gradient-to-tr from-primary/5 to-transparent rounded-full translate-y-6 -translate-x-6 pointer-events-none">
    </div>

    <!-- Image section with gradient overlay -->
    <div class="relative h-40 sm:h-44 md:h-48 bg-gradient-to-br from-primary to-[#5a7ca3] overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-t from-black/30 via-black/10 to-transparent z-10"></div>
        <div class="absolute inset-0 bg-gradient-to-br from-primary/15 to-transparent z-10"></div>

        @if (!empty($event['cover_event']))
            <img src="{{ $event['cover_event'] }}" alt="{{ $event['name'] }} Cover"
                class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105" />
        @else
            <div class="w-full h-full flex items-center justify-center text-white relative">
                <div class="absolute inset-0 bg-gradient-to-br from-primary/80 to-[#5a7ca3]/80"></div>
                <div class="relative z-10 text-center">
                    <div
                        class="w-12 h-12 bg-white/20 backdrop-blur-sm rounded-xl flex items-center justify-center mx-auto mb-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
                            <circle cx="8.5" cy="8.5" r="1.5"></circle>
                            <polyline points="21 15 16 10 5 21"></polyline>
                        </svg>
                    </div>
                    <p class="text-xs font-medium opacity-90">No Image</p>
                </div>
            </div>
        @endif

        <!-- Status badge (Free/Paid) -->
        <div class="absolute top-3 right-3 z-20">
            @if (!empty($event['price']) && $event['price'] > 0)
                <div
                    class="inline-flex items-center gap-1 bg-gradient-to-r from-emerald-500 to-emerald-600 text-white text-xs font-semibold px-3 py-1.5 rounded-full shadow-md border border-white/20">
                    Rp {{ number_format($event['price'], 0, ',', '.') }}
                </div>
            @else
                <div
                    class="inline-flex items-center gap-1 bg-gradient-to-r from-primary to-[#5a7ca3] text-white text-xs font-semibold px-3 py-1.5 rounded-full shadow-md border border-white/20">
                    <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z" />
                        <line x1="3" y1="6" x2="21" y2="6" />
                        <path d="M16 10a4 4 0 0 1-8 0" />
                    </svg>
                    FREE
                </div>
            @endif
        </div>
    </div>

    <!-- Card content -->
    <div class="p-4 sm:p-5 flex flex-col flex-grow bg-white relative">
        <!-- Event badges -->
        <div class="flex flex-wrap gap-2 mb-4">
            <span
                class="inline-flex items-center gap-1 px-3 py-1.5 bg-gradient-to-r from-primary to-[#5a7ca3] text-white text-xs font-semibold rounded-full shadow-sm hover:shadow-md transition-shadow duration-300">
                <div class="w-1.5 h-1.5 bg-white rounded-full animate-pulse"></div>
                {{ $event['division'] ?? 'Unknown' }}
            </span>
            <span
                class="inline-flex items-center gap-1 px-3 py-1.5 bg-gray-100 text-gray-700 text-xs font-semibold rounded-full border border-gray-200 hover:bg-gray-200 transition-colors duration-300">
                <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <polygon points="12 2 2 7 12 12 22 7 12 2" />
                    <polyline points="2 17 12 22 22 17" />
                    <polyline points="2 12 12 17 22 12" />
                </svg>
                {{ strtoupper($event['type'] ?? 'N/A') }}
            </span>
        </div>

        <!-- Event title -->
        <div class="flex-grow mb-3">
            <h3
                class="text-base sm:text-lg font-semibold text-gray-900 group-hover:text-primary transition-colors duration-300 line-clamp-2 leading-tight">
                {{ $event['name'] }}
            </h3>
        </div>

        <!-- Date section -->
        <div class="mt-auto pt-3 border-t border-gray-200/80">
            <div class="flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                    stroke="var(--bg-primary)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                    <line x1="16" y1="2" x2="16" y2="6"></line>
                    <line x1="8" y1="2" x2="8" y2="6"></line>
                    <line x1="3" y1="10" x2="21" y2="10"></line>
                </svg>
                <span class="text-sm text-gray-700 font-medium">
                    {{ $event['start_date'] ?? 'Date TBA' }}
                </span>
            </div>
        </div>

        <!-- Call to action indicator -->
        <div class="mt-3 pt-3 border-t border-gray-200/80">
            <div class="flex items-center justify-between">
                <span class="text-xs text-gray-500 font-medium">View Details</span>
                <div
                    class="w-7 h-7 bg-primary/10 rounded-lg flex items-center justify-center group-hover:bg-primary group-hover:scale-110 transition-all duration-300">
                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none"
                        stroke="var(--bg-primary)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="group-hover:stroke-white transition-colors duration-300">
                        <path d="M5 12h14" />
                        <path d="M12 5l7 7-7 7" />
                    </svg>
                </div>
            </div>
        </div>
    </div>
</a>