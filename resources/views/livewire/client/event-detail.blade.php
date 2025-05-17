<div class="px-4 sm:px-8 md:px-12 py-6 sm:py-8 mt-16 sm:mt-20">
    <!-- Breadcrumb Navigation -->
    <div class="flex items-center gap-2 text-sm text-gray-600 mb-4 sm:mb-6 overflow-x-auto pb-2">
        <a wire:navigate href="{{ route('client.events') }}" class="hover:text-gray-900 whitespace-nowrap">
            Events
        </a>
        <span>/</span>
        <span class="font-bold text-[#343434] whitespace-nowrap">
            {{ $event->name }}
        </span>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 sm:gap-8">
        <!-- Left Column - Image -->
        <div class="col-span-1 space-y-6 lg:border-r-2 lg:border-gray-400 lg:pr-6">
            <div class="w-full h-48 sm:h-56 bg-[#343434] rounded-lg mb-4 sm:mb-7">
                @if($event->cover_event)
                    <img src="{{ $event->cover_event }}" alt="{{ $event->name }}"
                        class="w-full h-full object-cover rounded-lg">
                @endif
            </div>

            <!-- Event Info Cards -->
            <div class="space-y-4 sm:space-y-6 mx-2 sm:mx-8 md:mx-12 text-[#343434]">
                <div class="flex items-center gap-3">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="lucide lucide-calendar-days flex-shrink-0">
                        <path d="M8 2v4" />
                        <path d="M16 2v4" />
                        <rect width="18" height="18" x="3" y="4" rx="2" />
                        <path d="M3 10h18" />
                        <path d="M8 14h.01" />
                        <path d="M12 14h.01" />
                        <path d="M16 14h.01" />
                        <path d="M8 18h.01" />
                        <path d="M12 18h.01" />
                        <path d="M16 18h.01" />
                    </svg>
                    <span class="text-sm sm:text-base">
                        @if(isset($eventDate['date']))
                            <span class="font-semibold">{{ $eventDate['date'] }}</span>
                        @else
                            <span class="text-gray-500">Tanggal belum tersedia</span>
                        @endif
                    </span>
                </div>

                <div class="flex items-center gap-3">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="lucide lucide-clock flex-shrink-0">
                        <circle cx="12" cy="12" r="10" />
                        <polyline points="12 6 12 12 16 14" />
                    </svg>
                    <span class="font-semibold text-sm sm:text-base">
                        {{ \Carbon\Carbon::parse($event->start_time)->format('H:i') }} -
                        {{ \Carbon\Carbon::parse($event->end_time)->format('H:i') }}
                    </span>
                </div>

                <div class="flex items-center gap-3">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="lucide lucide-map-pin flex-shrink-0">
                        <path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z" />
                        <circle cx="12" cy="10" r="3" />
                    </svg>
                    <span class="font-semibold text-sm sm:text-base">
                        {{ $event->address }}
                    </span>
                </div>

                <div class="flex items-center gap-3">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="lucide lucide-users flex-shrink-0">
                        <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2" />
                        <circle cx="9" cy="7" r="4" />
                        <path d="M22 21v-2a4 4 0 0 0-3-3.87" />
                        <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                    </svg>
                    <span class="text-sm sm:text-base">
                        <span class="font-semibold">{{ $event->participants }}</span> Participant
                    </span>
                </div>
            </div>

            <!-- Email Input -->
            @if($showEmailInput)
                <form wire:submit.prevent="submitEmail" class="space-y-4 mt-6">
                    <input type="email" wire:model="email" class="w-full p-2 border border-gray-300 rounded-lg"
                        placeholder="Email" required />
                    <button type="submit"
                        class="w-full bg-[#343434] text-white py-2 sm:py-3 rounded-lg hover:bg-[#2a2a2a] transition-colors font-semibold cursor-pointer">
                        Notify Me!
                    </button>

                    <div class="text-center">
                        <span class="text-[#343434] text-sm sm:text-base font-bold">
                            <span class="text-gray-500 font-semibold">
                                Registration Opens in
                            </span>
                            {{ \Carbon\Carbon::parse($event->registration_start)->diffForHumans() }}
                        </span>
                    </div>
                </form>
            @endif

            <!-- Register Button -->
            @if(!$showEmailInput)
                <button
                    class="w-full bg-[#343434] text-white py-2 sm:py-3 rounded-lg hover:bg-[#2a2a2a] transition-colors cursor-pointer mt-6"
                    wire:click="toggleEmailInput">
                    Register
                </button>
            @endif
        </div>

        <!-- Right Column - Event Details -->
        <div class="col-span-1 lg:col-span-2 space-y-4 mt-6 lg:mt-0">
            <div class="flex flex-wrap gap-2 mb-4">
                <span class="px-3 py-1 bg-[#343434] text-white text-xs sm:text-sm rounded-lg">
                    {{ $event->division }}
                </span>
            </div>

            <h1 class="text-xl sm:text-2xl text-[#343434] font-bold mb-4 sm:mb-6">
                {{ $event->name }}
            </h1>

            <!-- Tabs Navigation -->
            <div class="relative flex border-2 rounded-lg border-gray-500 w-full sm:w-max p-1">
                <!-- Animated Slider -->
                <div class="absolute top-1 h-[calc(100%-0.5rem)] w-[calc(50%-0.5rem)] sm:w-[calc(50%-0.5rem)] bg-[#343434] rounded-lg z-0 transition-all duration-300 ease-out"
                    style="left: {{ $activeTab === 'overview' ? '0.25rem' : 'calc(50% + 0.25rem)' }}"></div>

                <button
                    class="relative z-10 py-1 sm:py-2 px-2 sm:px-6 text-xs sm:text-sm font-medium rounded-lg transition-colors w-1/2 sm:w-28 text-center {{ $activeTab === 'overview' ? 'text-white' : 'text-[#343434]' }}"
                    wire:click="switchTab('overview')">
                    Overview
                </button>

                <button
                    class="relative z-10 py-1 sm:py-2 px-2 sm:px-6 text-xs sm:text-sm font-medium rounded-lg transition-colors w-1/2 sm:w-28 text-center {{ $activeTab === 'speakers' ? 'text-white' : 'text-[#343434]' }}"
                    wire:click="switchTab('speakers')">
                    Speakers
                </button>
            </div>

            <!-- Tabs Content -->
            <div class="space-y-3 sm:space-y-4 text-[#000000] mt-4 text-sm sm:text-base">
                @if($activeTab === 'overview')
                    <div class="prose max-w-none">
                        {!! $event->description !!}
                    </div>
                @endif

                @if($activeTab === 'speakers')
                    <h2 class="text-lg sm:text-xl font-bold">Speakers</h2>

                    @if($event->speakers && count($event->speakers) > 0)
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mt-4">
                            @foreach($event->speakers as $speaker)
                                <div class="flex items-start gap-4 p-3 bg-gray-50 rounded-lg">
                                    <div class="w-12 h-12 rounded-full bg-gray-300 overflow-hidden flex-shrink-0">
                                        @if($speaker['photo'])
                                            <img src="{{ $speaker['photo'] }}" alt="{{ $speaker['name'] }}"
                                                class="w-full h-full object-cover">
                                        @endif
                                    </div>
                                    <div>
                                        <h3 class="font-bold">{{ $speaker['name'] }}</h3>
                                        <p class="text-sm text-gray-600">{{ $speaker['topic'] }}</p>
                                        <p class="text-xs text-gray-500 mt-1">{{ $speaker['bio'] }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p>Speakers will be announced soon...</p>
                    @endif
                @endif
            </div>

            <!-- Contact Information -->
            @if($event->contact_info)
                <div class="mt-6">
                    <p class="mb-2 text-sm sm:text-base">
                        Informasi lebih lanjut :
                    </p>
                    @foreach($event->contact_info as $contact)
                        <p class="text-sm sm:text-base">{{ $contact }}</p>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</div>

@if(session()->has('message'))
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            Toastify({
                text: "{{ session('message') }}",
                duration: 3000,
                close: true,
                gravity: "top",
                position: "right",
                backgroundColor: "#4CAF50",
            }).showToast();
        });
    </script>
@endif