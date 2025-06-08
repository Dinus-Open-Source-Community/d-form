@php
    use Carbon\Carbon;
@endphp

<div class="bg-white rounded-3xl shadow-xl overflow-hidden cursor-pointer transition-all duration-300 transform hover:scale-[1.02] hover:shadow-2xl hover:-translate-y-2 flex flex-col h-full group border border-gray-200/50 relative"
    wire:click="handleClick">

    <!-- Decorative gradient circles -->
    <div
        class="absolute top-0 right-0 w-20 h-20 bg-gradient-to-br from-primary/10 to-transparent rounded-full -translate-y-10 translate-x-10 pointer-events-none">
    </div>
    <div
        class="absolute bottom-0 left-0 w-16 h-16 bg-gradient-to-tr from-primary/5 to-transparent rounded-full translate-y-8 -translate-x-8 pointer-events-none">
    </div>

    <!-- Image section with enhanced gradient overlay -->
    <div class="relative h-48 sm:h-52 md:h-56 bg-gradient-to-br from-primary to-[#5a7ca3] overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-t from-black/40 via-black/20 to-transparent z-10"></div>
        <div class="absolute inset-0 bg-gradient-to-br from-primary/20 to-transparent z-10"></div>

        @if($event->cover_event)
            <img src="{{ $event->cover_event }}" alt="{{ $event->name }}"
                class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110" />
        @else
            <div class="w-full h-full flex items-center justify-center text-white relative">
                <div class="absolute inset-0 bg-gradient-to-br from-primary/90 to-[#5a7ca3]/90"></div>
                <div class="relative z-10 text-center">
                    <div
                        class="w-16 h-16 bg-white/20 backdrop-blur-sm rounded-2xl flex items-center justify-center mx-auto mb-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
                            <circle cx="8.5" cy="8.5" r="1.5"></circle>
                            <polyline points="21 15 16 10 5 21"></polyline>
                        </svg>
                    </div>
                    <p class="text-sm font-medium opacity-90">Event Image</p>
                </div>
            </div>
        @endif

        <!-- Enhanced status badge -->
        <div class="absolute top-4 right-4 z-20">
            @if($event->price > 0)
                <div
                    class="inline-flex items-center gap-1.5 bg-gradient-to-r from-emerald-500 to-emerald-600 backdrop-blur-sm text-white text-xs font-semibold px-4 py-2 rounded-full shadow-lg border border-white/20">
                    Rp {{ number_format($event->price, 0, ',', '.') }}
                </div>
            @else
                <div
                    class="inline-flex items-center gap-1.5 bg-gradient-to-r from-primary to-[#5a7ca3] backdrop-blur-sm text-white text-xs font-semibold px-4 py-2 rounded-full shadow-lg border border-white/20">
                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none"
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

    <!-- Enhanced card content -->
    <div class="p-6 flex flex-col flex-grow bg-white relative">
        <!-- Event badges with improved styling -->
        <div class="flex flex-wrap gap-2 mb-5">
            <span
                class="inline-flex items-center gap-1.5 px-4 py-2 bg-gradient-to-r from-primary to-[#5a7ca3] text-white text-xs font-semibold rounded-full shadow-md hover:shadow-lg transition-shadow duration-300">
                <div class="w-2 h-2 bg-white rounded-full animate-pulse"></div>
                {{ Str::ucfirst($event->division) }}
            </span>
            <span
                class="inline-flex items-center gap-1.5 px-4 py-2 bg-gray-100 text-gray-700 text-xs font-semibold rounded-full border border-gray-200 hover:bg-gray-200 transition-colors duration-300">
                <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <polygon points="12 2 2 7 12 12 22 7 12 2" />
                    <polyline points="2 17 12 22 22 17" />
                    <polyline points="2 12 12 17 22 12" />
                </svg>
                {{ Str::upper($event->type) }}
            </span>
        </div>

        <!-- Event title and description with better typography -->
        <div class="flex-grow mb-4">
            <h3
                class="text-lg font-bold mb-3 line-clamp-2 text-gray-900 group-hover:text-primary transition-colors duration-300 leading-tight">
                {{ $event->name }}
            </h3>
            <p class="text-sm text-gray-600 mb-4 line-clamp-3 leading-relaxed">
                {{ \Illuminate\Support\Str::limit(strip_tags($event->description), 140) }}
            </p>
        </div>

        <!-- Simple date and time section -->
        <div class="mt-auto pt-4 border-t border-gray-200/80">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                        stroke="var(--bg-primary)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                        <line x1="16" y1="2" x2="16" y2="6"></line>
                        <line x1="8" y1="2" x2="8" y2="6"></line>
                        <line x1="3" y1="10" x2="21" y2="10"></line>
                    </svg>
                    <span class="text-sm text-gray-700 font-medium">
                        {{ $eventDate['date'] ?? 'Tanggal TBA' }}
                    </span>
                </div>
                <div class="flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                        stroke="var(--bg-primary)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="10"></circle>
                        <polyline points="12 6 12 12 16 14"></polyline>
                    </svg>
                    <span class="text-sm text-gray-700 font-medium">
                        {{ $timeRange ?? 'Waktu TBA' }}
                    </span>
                </div>
            </div>
        </div>

        <!-- Call to action indicator -->
        <div class="mt-4 pt-3 border-t border-gray-200/80">
            <div class="flex items-center justify-between">
                <span class="text-xs text-gray-500 font-medium">Klik untuk detail</span>
                <div
                    class="w-8 h-8 bg-primary/10 rounded-lg flex items-center justify-center group-hover:bg-primary group-hover:scale-110 transition-all duration-300">
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none"
                        stroke="var(--bg-primary)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="group-hover:stroke-white transition-colors duration-300">
                        <path d="M5 12h14" />
                        <path d="M12 5l7 7-7 7" />
                    </svg>
                </div>
            </div>
        </div>
    </div>
</div>