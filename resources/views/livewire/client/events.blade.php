<div class="pt-32 min-h-screen bg-gradient-to-br from-gray-50 to-blue-50/30">
    <!-- Hero Section -->
    <div class="absolute inset-0 bg-gradient-to-b from-primary/15 to-transparent"></div>
    <div class="relative overflow-hidden px-6 sm:px-8 md:px-12">
        <div class="relative py-16 sm:py-20 md:py-24">
            <div class="max-w-4xl mx-auto text-center">
                <!-- Badge -->
                <div class="inline-flex items-center gap-2 bg-primary/10 px-4 py-2 rounded-full mb-6">
                    <div class="w-2 h-2 bg-primary rounded-full animate-pulse"></div>
                    <span class="text-primary font-medium text-base">Event Doscom</span>
                </div>

                <!-- Title -->
                <h1 class="text-4xl sm:text-5xl md:text-6xl font-bold text-gray-900 mb-6 leading-tight">
                    Doscom
                    <span class="bg-primary bg-clip-text text-transparent" style="background-image: linear-gradient(90deg, var(--bg-primary), var(--bg-primary));">
                        Event
                    </span>
                </h1>

                <!-- Description -->
                <p class="text-lg sm:text-xl text-gray-600 max-w-3xl mx-auto leading-relaxed">
                    Temukan berbagai event menarik yang diselenggarakan khusus untuk mahasiswa
                </p>
            </div>
        </div>
    </div>

    <!-- Search and Filter Section -->
    <div class="px-6 sm:px-8 md:px-12 mb-8">
        <div class="max-w-7xl mx-auto">
            <div class="bg-white rounded-3xl shadow-xl border border-gray-200/50 p-6 sm:p-8 relative overflow-hidden">
                <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-br from-primary/10 to-transparent rounded-full -translate-y-16 translate-x-16"></div>
                <div class="relative">
                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                        <!-- Search Bar -->
                        <div class="lg:col-span-2">
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                                        fill="none" stroke="var(--bg-primary)" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <circle cx="11" cy="11" r="8" />
                                        <path d="M21 21l-4.35-4.35" />
                                    </svg>
                                </div>
                                <input type="text" 
                                    wire:model.live.debounce.500ms="search"
                                    placeholder="Cari event berdasarkan nama, deskripsi, atau lokasi..."
                                    class="w-full pl-12 pr-4 py-4 bg-gray-50 border border-gray-200 rounded-2xl focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all duration-300 text-gray-900 placeholder-gray-500">
                            </div>
                        </div>

                        <!-- Filter Dropdown -->
                        <div class="relative">
                            <select wire:model.live="categoryFilter"
                                class="w-full py-4 px-4 bg-gray-50 border border-gray-200 rounded-2xl focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all duration-300 text-gray-900 appearance-none">
                                <option value="">Semua Kategori</option>
                                <option value="general">General</option>
                                <option value="programming">Programming</option> 
                                <option value="multimedia">Multimedia</option>
                                <option value="networking">Networking</option>
                            </select>
                            <div class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                                    fill="none" stroke="var(--bg-primary)" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <path d="M6 9l6 6 6-6" />
                                </svg>
                            </div>
                        </div>
                    </div>

                    <!-- Search Results Info -->
                    @if($search || $categoryFilter)
                        <div class="mt-4 pt-4 border-t border-gray-100">
                            <div class="flex items-center justify-between flex-wrap gap-2">
                                <div class="text-sm text-gray-600">
                                    @if($search && $categoryFilter)
                                        Menampilkan hasil untuk "<strong>{{ $search }}</strong>" dalam kategori "<strong>{{ ucfirst($categoryFilter) }}</strong>"
                                    @elseif($search)
                                        Menampilkan hasil untuk "<strong>{{ $search }}</strong>"
                                    @elseif($categoryFilter)
                                        Menampilkan event kategori "<strong>{{ ucfirst($categoryFilter) }}</strong>"
                                    @endif
                                </div>
                                
                                <!-- Clear filters button -->
                                <button wire:click="clearFilters" 
                                    type="button"
                                    class="text-primary hover:text-[#5a7ca3] font-medium text-sm bg-primary/10 hover:bg-primary/20 px-3 py-1 rounded-full transition-all duration-200 flex items-center gap-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M18 6 6 18"/>
                                        <path d="M6 6l12 12"/>
                                    </svg>
                                    Hapus filter
                                </button>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Event List Component -->
    <livewire:client.components.event-list 
        :search="$search"
        :categoryFilter="$categoryFilter"
        :showToday="true"
        :key="'event-list-'.md5($search.'-'.$categoryFilter.'-'.request()->get('page', 1))"
    />
</div>