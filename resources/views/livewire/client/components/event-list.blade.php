<div class="min-h-screen bg-gradient-to-br from-gray-50 to-blue-50/30 py-8 sm:py-16">
    <div class="px-4 sm:px-6 md:px-10 max-w-8xl mx-auto">
        @if($useSearchMode)
            <div class="mb-12 sm:mb-16">
                <div class="text-center mb-8 sm:mb-12">
                    <div class="inline-flex items-center gap-2 bg-[var(--bg-primary)]/10 px-4 py-2 rounded-full mb-4">
                        <div class="w-2 h-2 bg-[var(--bg-primary)] rounded-full animate-pulse"></div>
                        <span class="text-[var(--bg-primary)] font-medium text-sm">Hasil Pencarian</span>
                    </div>
                    <h2 class="text-3xl sm:text-4xl font-bold text-gray-900 mb-4">
                        Event
                        <span class="bg-gradient-to-r from-[var(--bg-primary)] to-[#5a7ca3] bg-clip-text text-transparent">
                            Ditemukan
                        </span>
                    </h2>
                    <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                        @if(isset($totalResults))
                            Ditemukan {{ $totalResults }} event sesuai pencarian Anda
                        @else
                            Berikut adalah hasil pencarian event sesuai filter Anda
                        @endif
                    </p>
                </div>
                
                @if($isLoading)
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4 lg:gap-6">
                        @for($i = 0; $i < 8; $i++)
                            <div class="bg-white rounded-3xl shadow-xl border border-gray-200/50 overflow-hidden">
                                <div class="bg-gradient-to-br from-gray-200 to-gray-300 animate-pulse h-56"></div>
                                <div class="p-6">
                                    <div class="flex gap-2 mb-4">
                                        <div class="bg-gray-200 animate-pulse h-6 w-20 rounded-full"></div>
                                        <div class="bg-gray-200 animate-pulse h-6 w-16 rounded-full"></div>
                                    </div>
                                    <div class="bg-gray-200 animate-pulse h-6 w-full mb-3 rounded"></div>
                                    <div class="bg-gray-200 animate-pulse h-4 w-3/4 mb-4 rounded"></div>
                                    <div class="bg-gray-200 animate-pulse h-4 w-1/2 rounded"></div>
                                </div>
                            </div>
                        @endfor
                    </div>
                @elseif($events->count() === 0)
                    <div class="col-span-full">
                        <div class="bg-white rounded-3xl shadow-xl border border-gray-200/50 p-12 text-center relative overflow-hidden max-w-2xl mx-auto">
                            <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-br from-[var(--bg-primary)]/10 to-transparent rounded-full -translate-y-16 translate-x-16"></div>
                            <div class="relative">
                                <div class="w-20 h-20 bg-gradient-to-r from-[var(--bg-primary)]/10 to-[var(--bg-primary)]/5 rounded-2xl flex items-center justify-center mx-auto mb-4">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="var(--bg-primary)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <circle cx="11" cy="11" r="8"/>
                                        <path d="M21 21l-4.35-4.35"/>
                                    </svg>
                                </div>
                                <h3 class="text-xl font-bold text-gray-900 mb-2">Tidak Ada Event Ditemukan</h3>
                                <p class="text-gray-600 mb-4">Coba gunakan kata kunci atau kategori lain</p>
                                <button wire:click="clearFilters" 
                                    type="button"
                                    class="inline-flex items-center gap-2 bg-[var(--bg-primary)] hover:bg-[#5a7ca3] text-white px-4 py-2 rounded-lg font-medium transition-colors duration-200">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M3 6h18"/>
                                        <path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/>
                                        <path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/>
                                    </svg>
                                    Hapus Filter
                                </button>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4 lg:gap-6 mb-8">
                        @foreach($events as $event)
                            <livewire:client.components.event-card :event="$event" :key="'search-'.$event->id" :wire:key="'search-'.$event->id" />
                        @endforeach
                    </div>
                    
                    <!-- Simplified Pagination -->
                    @if($events->hasPages())
                        <div class="flex justify-center mt-20">
                            <div class="flex items-center gap-2">
                                <!-- Previous Button -->
                                <button 
                                    wire:click="previousPage" 
                                    @disabled($events->onFirstPage())
                                    class="px-4 py-2 rounded-lg border border-gray-300 {{ $events->onFirstPage() ? 'bg-gray-100 text-gray-400 cursor-not-allowed' : 'bg-white text-[#466F97] hover:bg-[#466F97] hover:text-white' }}">
                                    Sebelumnya
                                </button>

                                <!-- Page Numbers -->
                                @foreach(range(1, $events->lastPage()) as $page)
                                    <button 
                                        wire:click="gotoPage({{ $page }})" 
                                        class="w-10 h-10 flex items-center justify-center rounded-lg {{ $page === $events->currentPage() ? 'bg-[#466F97] text-white' : 'bg-white text-[#466F97] hover:bg-gray-100' }}">
                                        {{ $page }}
                                    </button>
                                @endforeach

                                <!-- Next Button -->
                                <button 
                                    wire:click="nextPage" 
                                    @disabled(!$events->hasMorePages())
                                    class="px-4 py-2 rounded-lg border border-gray-300 {{ !$events->hasMorePages() ? 'bg-gray-100 text-gray-400 cursor-not-allowed' : 'bg-white text-[#466F97] hover:bg-[#466F97] hover:text-white' }}">
                                    Selanjutnya
                                </button>
                            </div>
                        </div>
                    @endif
                @endif
            </div>
        @else
            @if($showToday)
                <section class="mb-12 sm:mb-16">
                    <!-- Today's Events Header -->
                    <div class="text-center mb-8 sm:mb-12">
                        <div class="inline-flex items-center gap-2 bg-[var(--bg-primary)]/10 px-4 py-2 rounded-full mb-4">
                            <div class="w-2 h-2 bg-[var(--bg-primary)] rounded-full animate-pulse"></div>
                            <span class="text-[var(--bg-primary)] font-medium text-sm">Hari Ini</span>
                        </div>
                        <h2 class="text-3xl sm:text-4xl font-bold text-gray-900 mb-4">
                            Event
                            <span class="bg-gradient-to-r from-[var(--bg-primary)] to-[#5a7ca3] bg-clip-text text-transparent">
                                Hari Ini
                            </span>
                        </h2>
                        <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                            Jangan lewatkan event menarik yang sedang berlangsung hari ini
                        </p>
                    </div>

                    @if($hasError && $statusCode === 404 && count($todayEvents) === 0)
                        <div class="bg-white rounded-3xl shadow-xl border border-gray-200/50 p-12 text-center relative overflow-hidden max-w-2xl mx-auto">
                            <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-br from-[var(--bg-primary)]/10 to-transparent rounded-full -translate-y-16 translate-x-16"></div>
                            <div class="relative">
                                <div class="w-20 h-20 bg-gradient-to-r from-[var(--bg-primary)]/10 to-[var(--bg-primary)]/5 rounded-2xl flex items-center justify-center mx-auto mb-4">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="var(--bg-primary)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <rect x="3" y="4" width="18" height="18" rx="2" ry="2"/>
                                        <line x1="16" y1="2" x2="16" y2="6"/>
                                        <line x1="8" y1="2" x2="8" y2="6"/>
                                        <line x1="3" y1="10" x2="21" y2="10"/>
                                    </svg>
                                </div>
                                <h3 class="text-xl font-bold text-gray-900 mb-2">Tidak Ada Event Hari Ini</h3>
                                <p class="text-gray-600">Belum ada event yang dijadwalkan untuk hari ini</p>
                            </div>
                        </div>
                    @endif

                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4 lg:gap-6">
                        @if($isLoading && count($todayEvents) === 0)
                            @for($i = 0; $i < 3; $i++)
                                <div class="bg-white rounded-3xl shadow-xl border border-gray-200/50 overflow-hidden">
                                    <div class="bg-gradient-to-br from-gray-200 to-gray-300 animate-pulse h-56"></div>
                                    <div class="p-6">
                                        <div class="flex gap-2 mb-4">
                                            <div class="bg-gray-200 animate-pulse h-6 w-20 rounded-full"></div>
                                            <div class="bg-gray-200 animate-pulse h-6 w-16 rounded-full"></div>
                                        </div>
                                        <div class="bg-gray-200 animate-pulse h-6 w-full mb-3 rounded"></div>
                                        <div class="bg-gray-200 animate-pulse h-4 w-3/4 mb-4 rounded"></div>
                                        <div class="bg-gray-200 animate-pulse h-4 w-1/2 rounded"></div>
                                    </div>
                                </div>
                            @endfor
                        @endif

                        @foreach($todayEvents as $event)
                            <livewire:client.components.event-card :event="$event" :key="'today-'.$event->id" :wire:key="'today-'.$event->id" />
                        @endforeach
                    </div>
                </section>
            @endif

            <section>
                <!-- Upcoming Events Header -->
                <div class="text-center mb-8 sm:mb-12">
                    <div class="inline-flex items-center gap-2 bg-[var(--bg-primary)]/10 px-4 py-2 rounded-full mb-4">
                        <div class="w-2 h-2 bg-[var(--bg-primary)] rounded-full animate-pulse"></div>
                        <span class="text-[var(--bg-primary)] font-medium text-sm">Mendatang</span>
                    </div>
                    <h2 class="text-3xl sm:text-4xl font-bold text-gray-900 mb-4">
                        Event
                        <span class="bg-gradient-to-r from-[var(--bg-primary)] to-[#5a7ca3] bg-clip-text text-transparent">
                            Mendatang
                        </span>
                    </h2>
                    <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                        Temukan dan daftarkan diri Anda untuk event-event menarik yang akan datang
                    </p>
                </div>

                @if($hasError && $statusCode === 404 && count($upcomingEvents) === 0)
                    <div class="bg-white rounded-3xl shadow-xl border border-gray-200/50 p-12 text-center relative overflow-hidden max-w-2xl mx-auto">
                        <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-br from-[var(--bg-primary)]/10 to-transparent rounded-full -translate-y-16 translate-x-16"></div>
                        <div class="relative">
                            <div class="w-20 h-20 bg-gradient-to-r from-[var(--bg-primary)]/10 to-[var(--bg-primary)]/5 rounded-2xl flex items-center justify-center mx-auto mb-4">
                                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="var(--bg-primary)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <circle cx="12" cy="12" r="10"/>
                                    <path d="M12 6v6l4 2"/>
                                </svg>
                            </div>
                            <h3 class="text-xl font-bold text-gray-900 mb-2">Belum Ada Event Mendatang</h3>
                            <p class="text-gray-600">Event baru akan segera diumumkan, pantau terus halaman ini</p>
                        </div>
                    </div>
                @endif

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4 lg:gap-6">
                    @if($isLoading && count($upcomingEvents) === 0)
                        @for($i = 0; $i < 8; $i++)
                            <div class="bg-white rounded-3xl shadow-xl border border-gray-200/50 overflow-hidden">
                                <div class="bg-gradient-to-br from-gray-200 to-gray-300 animate-pulse h-56"></div>
                                <div class="p-6">
                                    <div class="flex gap-2 mb-4">
                                        <div class="bg-gray-200 animate-pulse h-6 w-20 rounded-full"></div>
                                        <div class="bg-gray-200 animate-pulse h-6 w-16 rounded-full"></div>
                                    </div>
                                    <div class="bg-gray-200 animate-pulse h-6 w-full mb-3 rounded"></div>
                                    <div class="bg-gray-200 animate-pulse h-4 w-3/4 mb-4 rounded"></div>
                                    <div class="bg-gray-200 animate-pulse h-4 w-1/2 rounded"></div>
                                </div>
                            </div>
                        @endfor
                    @endif
                    
                    @foreach($upcomingEvents as $event)
                        <livewire:client.components.event-card :event="$event" :key="'upcoming-'.$event->id" :wire:key="'upcoming-'.$event->id" />
                    @endforeach
                </div>
            </section>
        @endif
    </div>
</div>