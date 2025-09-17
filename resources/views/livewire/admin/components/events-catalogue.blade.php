<section class="mb-8">
    <!-- Header -->
    <div class="flex justify-between items-center mb-4 sm:mb-6">
        <div class="flex items-center">
            <h2 class="text-lg sm:text-xl md:text-2xl font-semibold text-gray-900 tracking-tight">
                {{ $title }}
            </h2>
            @if ($showSeeAll)
                <a href="#" class="ml-4 inline-flex items-center text-sm font-medium text-white bg-primary hover:bg-[#3B5C80] px-3 py-1.5 rounded-lg transition duration-200 group">
                    See All
                    <span class="ml-2 bg-white text-primary px-2 py-0.5 rounded-md text-xs font-semibold group-hover:bg-gray-100 transition duration-200">
                        {{ count($events) }}
                    </span>
                </a>
            @endif
        </div>
    </div>

    <!-- Events Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-6">
        @forelse ($events as $event)
            <livewire:admin.components.event-card :event="$event" :key="$event['id']" />
        @empty
            <div class="col-span-1 sm:col-span-2 lg:col-span-3 text-center text-gray-600 text-sm font-medium py-8">No Events Found</div>
        @endforelse

        <!-- QR Card -->
        @if ($useQR)
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden cursor-pointer transition-all duration-300 transform hover:scale-[1.02] hover:shadow-xl hover:-translate-y-1 flex flex-col h-full group border border-gray-200/30 relative">
                <!-- Decorative gradient circles -->
                <div
                    class="absolute top-0 right-0 w-16 h-16 bg-gradient-to-br from-primary/10 to-transparent rounded-full -translate-y-8 translate-x-8 pointer-events-none">
                </div>
                <div
                    class="absolute bottom-0 left-0 w-12 h-12 bg-gradient-to-tr fromMX-3/5 to-transparent rounded-full translate-y-6 -translate-x-6 pointer-events-none">
                </div>

                <!-- Placeholder Image -->
                <div class="relative h-40 sm:h-44 md:h-48 bg-gradient-to-br from-primary to-[#5a7ca3] overflow-hidden">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/30 via-black/10 to-transparent z-10"></div>
                    <div class="absolute inset-0 bg-gradient-to-br from-primary/15 to-transparent z-10"></div>
                    <div class="w-full h-full flex items-center justify-center text-white relative">
                        <div class="absolute inset-0 bg-gradient-to-br from-primary/80 to-[#5a7ca3]/80"></div>
                        <div class="relative z-10 text-center">
                            <div
                                class="w-12 h-12 bg-white/20 backdrop-blur-sm rounded-xl flex items-center justify-center mx-auto mb-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <rect x="3" y="3" width="7" height="7"></rect>
                                    <rect x="14" y="3" width="7" height="7"></rect>
                                    <rect x="14" y="14" width="7" height="7"></rect>
                                    <rect x="3" y="14" width="7" height="7"></rect>
                                </svg>
                            </div>
                            <p class="text-xs font-medium opacity-90">Scan QR</p>
                        </div>
                    </div>
                </div>

                <!-- Button Section -->
                <div class="p-4 sm:p-5 flex flex-col items-center">
                    <div class="flex flex-wrap gap-3 justify-center">
                        <a href="" wire:navigate>
                            <button class="bg-primary text-white px-4 py-2 rounded-lg text-sm font-semibold hover:bg-[#3B5C80] transition duration-200 transform hover:scale-105 focus:ring-2 focus:ring-primary/30">
                                Scan QR
                            </button>
                        </a>
                        <button class="bg-white text-primary px-4 py-2 rounded-lg text-sm font-semibold border border-gray-200 hover:bg-gray-100 transition duration-200 transform hover:scale-105 focus:ring-2 focus:ring-primary/30">
                            Details
                        </button>
                    </div>
                </div>
            </div>
        @endif
    </div>
</section>