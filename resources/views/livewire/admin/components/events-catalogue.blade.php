<section class="mb-8">
    <div class="flex justify-between items-center mb-3 sm:mb-5">
        <div class="flex items-center">
            <h2 class="text-lg sm:text-1xl text-[#343434] font-medium mr-3">
                {{ $title }}
            </h2>
            @if ($showSeeAll)
                <button class="text-sm text-white bg-[#343434] px-3 py-1 rounded-lg">
                    See All
                    <span class="border border-white bg-white text-black ml-2 px-2 py-0 rounded-md">
                        {{ count($events) }}
                    </span>
                </button>
            @endif
        </div>
    </div>

    @if ($notFound)
        <div class="text-center text-gray-500">No Events Found.</div>
    @endif

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 mt-4 gap-4">
        @forelse ($events as $event)
            <livewire:admin.components.event-card :event="$event" :key="$event['id']" />
        @empty
            <div class="col-span-3 text-center text-gray-500">Loading events...</div>
        @endforelse

        @if ($useQR)
            <div class="bg-white rounded-lg shadow-md overflow-hidden cursor-pointer">
                <div class="h-36 sm:h-40 md:h-48 bg-[#343434]"></div>
                <div class="p-3 sm:p-8 items-center">
                    <div class="flex flex-wrap gap-2 justify-center">
                        <a href="" wire:navigate>
                            <button class="bg-[#343434] text-white px-4 py-2 rounded-lg mx-1 border-2 border-gray-400 transition-transform transform hover:scale-105 hover:bg-black/10 hover:text-black">
                                Scan QR
                            </button>
                        </a>
                        <button class="bg-white text-[#343434] px-4 py-2 rounded-lg mx-1 border-2 border-gray-400 transition-transform transform hover:scale-105 hover:bg-gray-200">
                            Details
                        </button>
                    </div>
                </div>
            </div>
        @endif
    </div>
</section>
