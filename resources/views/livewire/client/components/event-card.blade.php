@php
    use Carbon\Carbon;
@endphp

<div 
    class="bg-white rounded-xl shadow-md overflow-hidden cursor-pointer transition-transform transform hover:scale-105 flex flex-col h-full"
     wire:click="handleClick"
>
    <!-- Image section -->
    <div class="h-36 sm:h-40 md:h-48 bg-[#343434] overflow-hidden">
        @if($event->cover_event)
            <img
                src="{{ $event->cover_event }}"
                alt="{{ $event->name }}"
                class="w-full h-full object-cover"
            />
        @else
            <div class="w-full h-full flex items-center justify-center text-white">
                <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
                    <circle cx="8.5" cy="8.5" r="1.5"></circle>
                    <polyline points="21 15 16 10 5 21"></polyline>
                </svg>
            </div>
        @endif
    </div>

    <!-- Card content -->
    <div class="p-3 sm:p-4 border-x-2 border-b-2 rounded-b-xl border-gray-400 flex flex-col flex-grow">
        <!-- Price badge -->
        @if($event->price > 0)
            <div class="mb-2">
                <span class="inline-block bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded-full">
                    Rp {{ number_format($event->price, 0, ',', '.') }}
                </span>
            </div>
        @else
            <div class="mb-2">
                <span class="inline-block bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded-full">
                    FREE
                </span>
            </div>
        @endif

        <!-- Event title and description -->
        <div class="flex-grow">
            <h3 class="text-sm sm:text-base font-medium mb-1 sm:mb-2 line-clamp-2">
                {{ $event->name }}
            </h3>
            <p class="text-xs sm:text-sm text-gray-600 mb-2">
                {{ \Illuminate\Support\Str::limit($event->description, 100) }}
            </p>
        </div>

        <!-- Organizer -->
        <p class="text-xs text-gray-500 mt-1">
            By: {{ $event->user->name }}
        </p>

        <!-- Date section -->
        <div class="mt-2 pt-2 border-t border-gray-200">
            <p class="text-sm text-gray-500">
                <b>{{ $eventDate['days'] ?? '' }}</b> 
                {{ $eventDate['months'] ?? '' }}
            </p>
            <p class="text-xs text-gray-400 mt-1">
                {{ Carbon::parse($event->start_time)->format('H:i') }} - 
                {{ Carbon::parse($event->end_time)->format('H:i') }}
            </p>
        </div>
    </div>
</div>