<div class="py-6 sm:py-8 px-4 sm:px-8 md:px-12">
    @if($showToday)
        <section class="mb-6 sm:mb-8">
            <h2 class="text-lg sm:text-1xl text-[#343434] mb-3 sm:mb-5 font-medium">Today's Events</h2>
            @if($hasError && $statusCode === 404 && count($todayEvents) === 0)
                <div class="flex justify-center items-center p-8 bg-gray-100 rounded-lg">
                    <p class="text-gray-600">No events found</p>
                </div>
            @endif

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4">
                @if($isLoading && count($todayEvents) === 0)
                    @for($i = 0; $i < 3; $i++)
                        <div class="bg-gray-200 animate-pulse h-64 rounded-xl"></div>
                    @endfor
                @endif
                
                @foreach($todayEvents as $event)
                    <livewire:client.components.event-card :event="$event" :key="'today-'.$event->id" :wire:key="'today-'.$event->id" />
                @endforeach
            </div>
        </section>
    @endif

    <section>
        <h2 class="text-lg sm:text-1xl text-[#343434] mb-3 sm:mb-5 font-medium">Upcoming Events</h2>
        @if($hasError && $statusCode === 404 && count($upcomingEvents) === 0)
            <div class="flex justify-center items-center p-8 bg-gray-100 rounded-lg">
                <p class="text-gray-600">No events found</p>
            </div>
        @endif

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4">
            @if($isLoading && count($upcomingEvents) === 0)
                @for($i = 0; $i < 3; $i++)
                    <div class="bg-gray-200 animate-pulse h-64 rounded-xl"></div>
                @endfor
            @endif
            
            @foreach($upcomingEvents as $event)
                <livewire:client.components.event-card :event="$event" :key="'upcoming-'.$event->id" :wire:key="'upcoming-'.$event->id" />
            @endforeach
        </div>
    </section>
</div>