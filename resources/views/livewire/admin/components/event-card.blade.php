<a
    class="bg-white rounded-lg shadow-md overflow-hidden cursor-pointer transition-transform transform hover:scale-105 flex flex-col h-full"
    href="{{ route('admin.event-detail', $event['id']) }}"
    wire:navigate
>
    @if (!empty($event['cover_event']))
        <img src="{{ $event['cover_event'] }}" alt="{{ $event['name'] }} Cover" class="h-36 sm:h-40 md:h-48 w-full object-cover" />
    @else
        <div class="h-36 sm:h-40 md:h-48 bg-[#343434]"></div>
    @endif

    <div class="p-3 sm:p-4 border-x-2 border-b-2 rounded-b-lg border-gray-400 flex flex-col flex-grow">
        <div class="flex flex-wrap gap-2 mb-2">
            <span class="inline-block text-xs font-medium px-3 py-1 rounded-lg bg-[#343434] text-white">
                {{ $event['division'] ?? 'Unknown' }}
            </span>
        </div>

        <h3 class="text-base font-medium mb-2 min-h-[2.5rem]">
            {{ $event['name'] }}
        </h3>

        <p class="text-sm text-gray-600 mt-auto">
            {{ $event['start_date'] }}
        </p>
    </div>
</a>
