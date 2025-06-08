<div class="pt-32 min-h-screen bg-gradient-to-br from-gray-50 to-blue-50/30">
    <!-- Hero Section -->
    <div class="absolute inset-0 bg-gradient-to-b from-primary/10 to-transparent"></div>

    <!-- Main Content -->
    <div class="px-4 sm:px-6 md:px-12 pb-10 sm:pb-16 md:pb-20">
        <div class="relative py-6 sm:py-12 md:py-16">
            <div class="max-w-7xl mx-auto">
                <div class="flex flex-col lg:flex-row gap-6 lg:gap-12">
                    <!-- Left Column - Event Image & Info -->
                    <div class="w-full lg:w-[480px] xl:w-[540px] space-y-6">
                        <!-- Event Image Card -->
                        <div
                            class="bg-white rounded-3xl shadow-xl border border-gray-200/50 p-4 sm:p-6 relative overflow-hidden">
                            <div
                                class="absolute top-0 right-0 w-20 h-20 sm:w-32 sm:h-32 bg-gradient-to-br from-primary/6 to-transparent rounded-full -translate-y-10 sm:-translate-y-16 translate-x-10 sm:translate-x-16">
                            </div>
                            <div class="relative">
                                <div
                                    class="w-full h-44 sm:h-56 xl:h-64 bg-gradient-to-br from-primary/20 to-primary/5 rounded-2xl mb-4 sm:mb-6 overflow-hidden">
                                    @if($event->cover_event)
                                        <img src="{{ $event->cover_event }}" alt="{{ $event->name }}"
                                            class="w-full h-full object-cover rounded-2xl hover:scale-105 transition-transform duration-500">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48"
                                                viewBox="0 0 24 24" fill="none" stroke="primary"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                <rect width="18" height="18" x="3" y="3" rx="2" ry="2" />
                                                <circle cx="9" cy="9" r="2" />
                                                <path d="M21 15l-3.086-3.086a2 2 0 0 0-2.828 0L6 21" />
                                            </svg>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <!-- Event Info Cards -->
                            <div
                                class="absolute top-0 right-0 w-16 h-16 sm:w-24 sm:h-24 bg-gradient-to-br from-primary/10 to-transparent rounded-full -translate-y-8 sm:-translate-y-12 translate-x-8 sm:translate-x-12">
                            </div>
                            <div class="relative space-y-4 sm:space-y-6">
                                <h3
                                    class="text-base sm:text-lg font-bold text-gray-900 mb-2 sm:mb-4 flex items-center gap-2">
                                    Detail Event
                                </h3>
                                <div class="space-y-3 sm:space-y-4">
                                    <div
                                        class="flex items-center gap-4 p-3 bg-gray-100/80 rounded-xl hover:bg-gray-200/60 transition-colors">
                                        <div
                                            class="w-10 h-10 bg-gradient-to-r from-primary to-[#5a7ca3] rounded-xl flex items-center justify-center flex-shrink-0">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                                viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round">
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
                                        </div>
                                        <div>
                                            <p class="text-xs font-medium text-gray-500 uppercase tracking-wide">Tanggal
                                            </p>
                                            <p class="text-sm font-semibold text-gray-900">
                                                @if(isset($eventDate['date']))
                                                    {{ $eventDate['date'] }}
                                                @else
                                                    <span class="text-gray-500">Tanggal belum tersedia</span>
                                                @endif
                                            </p>
                                        </div>
                                    </div>
                                    <div
                                        class="flex items-center gap-4 p-3 bg-gray-100/80 rounded-xl hover:bg-gray-200/60 transition-colors">
                                        <div
                                            class="w-10 h-10 bg-gradient-to-r from-primary to-[#5a7ca3] rounded-xl flex items-center justify-center flex-shrink-0">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                                viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round">
                                                <circle cx="12" cy="12" r="10" />
                                                <polyline points="12 6 12 12 16 14" />
                                            </svg>
                                        </div>
                                        <div>
                                            <p class="text-xs font-medium text-gray-500 uppercase tracking-wide">Waktu
                                            </p>
                                            <p class="text-sm font-semibold text-gray-900">
                                                {{ \Carbon\Carbon::parse($event->start_time)->format('H:i') }} -
                                                {{ \Carbon\Carbon::parse($event->end_time)->format('H:i') }}
                                            </p>
                                        </div>
                                    </div>
                                    <div
                                        class="flex items-center gap-4 p-3 bg-gray-100/80 rounded-xl hover:bg-gray-200/60 transition-colors">
                                        <div
                                            class="w-10 h-10 bg-gradient-to-r from-primary to-[#5a7ca3] rounded-xl flex items-center justify-center flex-shrink-0">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                                viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round">
                                                <path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z" />
                                                <circle cx="12" cy="10" r="3" />
                                            </svg>
                                        </div>
                                        <div>
                                            <p class="text-xs font-medium text-gray-500 uppercase tracking-wide">Lokasi
                                            </p>
                                            <p class="text-sm font-semibold text-gray-900">{{ $event->address }}</p>
                                        </div>
                                    </div>
                                    <div
                                        class="flex items-center gap-4 p-3 bg-gray-100/80 rounded-xl hover:bg-gray-200/60 transition-colors">
                                        <div
                                            class="w-10 h-10 bg-gradient-to-r from-primary to-[#5a7ca3] rounded-xl flex items-center justify-center flex-shrink-0">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                                viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round">
                                                <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2" />
                                                <circle cx="9" cy="7" r="4" />
                                                <path d="M22 21v-2a4 4 0 0 0-3-3.87" />
                                                <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                                            </svg>
                                        </div>
                                        <div>
                                            <p class="text-xs font-medium text-gray-500 uppercase tracking-wide">Peserta
                                            </p>
                                            <p class="text-sm font-semibold text-gray-900">{{ $event->participants }}
                                                Participant</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Registration Section -->
                        <div
                            class="bg-white rounded-3xl shadow-xl border border-gray-200/50 p-4 sm:p-6 relative overflow-hidden">
                            <div class="absolute inset-0 bg-gradient-to-r from-primary/5 to-transparent">
                            </div>
                            <div class="relative">
                                @if($showEmailInput)
                                    <form wire:submit.prevent="submitEmail" class="space-y-4">
                                        <h3 class="text-lg font-bold text-gray-900 mb-4">Notify Me!</h3>
                                        <div class="relative">
                                            <input type="email" wire:model="email"
                                                class="w-full p-4 pr-12 border-2 border-gray-200 rounded-xl focus:border-primary focus:ring-4 focus:ring-primary/10 transition-all duration-300 outline-none"
                                                placeholder="Masukkan email Anda" required />
                                            <div class="absolute right-4 top-1/2 transform -translate-y-1/2">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                    viewBox="0 0 24 24" fill="none" stroke="primary"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                    <path
                                                        d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z" />
                                                    <polyline points="22,6 12,13 2,6" />
                                                </svg>
                                            </div>
                                        </div>
                                        <button type="submit"
                                            class="w-full bg-gradient-to-r from-primary to-[#5a7ca3] text-white py-4 rounded-xl hover:shadow-lg hover:scale-105 transition-all duration-300 font-semibold flex items-center justify-center gap-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round">
                                                <path d="M22 2L11 13" />
                                                <polygon points="22,2 15,22 11,13 2,9 22,2" />
                                            </svg>
                                            Notify Me!
                                        </button>
                                        <div class="text-center p-4 bg-primary/5 rounded-xl">
                                            <p class="text-primary text-sm font-semibold">
                                                <span class="text-gray-600">Registration Opens in</span><br>
                                                {{ \Carbon\Carbon::parse($event->registration_start)->diffForHumans() }}
                                            </p>
                                        </div>
                                    </form>
                                @else
                                    <div class="text-center">
                                        <div
                                            class="w-16 h-16 bg-gradient-to-r from-primary to-[#5a7ca3] rounded-2xl flex items-center justify-center mx-auto mb-4">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round">
                                                <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2" />
                                                <circle cx="9" cy="7" r="4" />
                                                <path d="M22 21v-2a4 4 0 0 0-3-3.87" />
                                                <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                                            </svg>
                                        </div>
                                        <h3 class="text-lg font-bold text-gray-900 mb-2">Daftar Sekarang</h3>
                                        <p class="text-gray-600 text-base mb-6">Bergabunglah dengan event menarik ini</p>
                                        <button
                                            class="w-full bg-gradient-to-r from-primary to-[#5a7ca3] text-white py-4 rounded-xl hover:shadow-lg hover:scale-105 transition-all duration-300 font-semibold flex items-center justify-center gap-2"
                                            wire:click="toggleEmailInput">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round">
                                                <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2" />
                                                <circle cx="9" cy="7" r="4" />
                                                <path d="M22 21v-2a4 4 0 0 0-3-3.87" />
                                                <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                                            </svg>
                                            Register
                                        </button>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Right Column - Event Details -->
                    <div class="flex-1 space-y-6 sm:space-y-8">
                        <!-- Event Title Card -->
                        <div
                            class="bg-white rounded-3xl shadow-xl border border-gray-200/50 p-4 sm:p-8 relative overflow-hidden">
                            <!-- Event Tags -->
                            <div class="flex flex-wrap gap-2 mb-4 sm:mb-6">
                                <span
                                    class="px-3 py-1.5 bg-gradient-to-r from-primary to-[#5a7ca3] text-white text-xs font-semibold rounded-full">
                                    {{ Str::ucfirst($event->division) }}
                                </span>
                                <span
                                    class="px-3 py-1.5 bg-gray-100 text-primary text-xs font-semibold rounded-full border border-primary/20">
                                    {{ Str::upper($event->type) }}
                                </span>
                            </div>
                            <div
                                class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-br from-primary/10 to-transparent rounded-full -translate-y-16 translate-x-16">
                            </div>
                            <div class="relative">
                                <h1 class="text-3xl sm:text-4xl font-bold text-gray-900 mb-4 leading-tight">
                                    {{ $event->name }}
                                </h1>
                                <p class="text-lg text-gray-600">Bergabunglah dalam event yang menarik ini dan
                                    kembangkan
                                    potensi Anda bersama komunitas</p>
                            </div>
                        </div>

                        <!-- Tabs Section -->
                        <div
                            class="bg-white rounded-3xl shadow-xl border border-gray-200/50 p-4 sm:p-8 relative overflow-hidden">
                            <div
                                class="absolute top-0 left-0 w-16 h-16 sm:w-24 sm:h-24 bg-gradient-to-br from-primary/20 to-transparent rounded-full -translate-y-8 sm:-translate-y-12 -translate-x-8 sm:-translate-x-12">
                            </div>
                            <div class="relative">
                                <!-- Tabs Navigation -->
                                <div
                                    class="relative flex border-2 rounded-2xl border-gray-200 w-auto max-w-xs sm:max-w-md md:max-w-lg p-1 mb-6 sm:mb-8 overflow-x-auto">
                                    <!-- Animated Slider -->
                                    <div class="absolute top-1 left-1 h-11 w-[calc(50%-0.25rem)] bg-gradient-to-r from-primary to-[#5a7ca3] rounded-xl z-0 transition-all duration-300 ease-out shadow-lg"
                                        style="transform: translateX({{ $activeTab === 'overview' ? '0%' : '100%' }});">
                                    </div>

                                    <!-- Buttons -->
                                    <div class="relative flex w-full gap-2 z-10">
                                        <button class="py-3 px-4 text-sm font-semibold rounded-xl transition-all duration-300 flex-1 text-center focus:outline-none
                {{ $activeTab === 'overview' ? 'text-white' : 'text-gray-600 hover:text-primary' }}"
                                            wire:click="switchTab('overview')">
                                            <div class="flex items-center justify-center gap-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                    <circle cx="12" cy="12" r="3" />
                                                    <path
                                                        d="M12 1v6M12 17v6M4.22 4.22l4.24 4.24M15.54 15.54l4.24 4.24M1 12h6M17 12h6M4.22 19.78l4.24-4.24M15.54 8.46l4.24-4.24" />
                                                </svg>
                                                Overview
                                            </div>
                                        </button>

                                        <button class="py-3 px-4 text-sm font-semibold rounded-xl transition-all duration-300 flex-1 text-center focus:outline-none
                {{ $activeTab === 'speakers' ? 'text-white' : 'text-gray-600 hover:text-primary' }}"
                                            wire:click="switchTab('speakers')">
                                            <div class="flex items-center justify-center gap-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                    <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2" />
                                                    <circle cx="9" cy="7" r="4" />
                                                    <path d="M23 21v-2a4 4 0 0 0-3-3.87M16 3.13a4 4 0 0 1 0 7.75" />
                                                </svg>
                                                Speakers
                                            </div>
                                        </button>
                                    </div>
                                </div>

                                <!-- Tabs Content -->
                                <div class="space-y-4 sm:space-y-6">
                                    @if($activeTab === 'overview')
                                        <div class="flex items-center gap-3 mb-4 sm:mb-6">
                                            <div
                                                class="w-12 h-12 bg-gradient-to-r from-primary to-[#5a7ca3] rounded-xl flex items-center justify-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2"
                                                    stroke-linecap="round" stroke-linejoin="round">
                                                    <path d="M4 19.5V8a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v11.5" />
                                                    <path d="M16 3v4" />
                                                    <path d="M8 3v4" />
                                                    <rect x="4" y="7" width="16" height="13" rx="2" />
                                                    <path d="M9 12h6" />
                                                </svg>
                                            </div>
                                            <h2 class="text-2xl font-bold text-gray-900">Overview</h2>
                                        </div>
                                        <div class="prose max-w-none">
                                            <div class="text-gray-700 leading-relaxed space-y-4">
                                                {!! $event->description !!}
                                            </div>
                                        </div>
                                    @endif

                                    @if($activeTab === 'speakers')
                                        <div class="space-y-6">
                                            <div class="flex items-center gap-3 mb-4 sm:mb-6">
                                                <div
                                                    class="w-12 h-12 bg-gradient-to-r from-primary to-[#5a7ca3] rounded-xl flex items-center justify-center">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                        viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2"
                                                        stroke-linecap="round" stroke-linejoin="round">
                                                        <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2" />
                                                        <circle cx="9" cy="7" r="4" />
                                                        <path d="M23 21v-2a4 4 0 0 0-3-3.87M16 3.13a4 4 0 0 1 0 7.75" />
                                                    </svg>
                                                </div>
                                                <h2 class="text-2xl font-bold text-gray-900">Speakers</h2>
                                            </div>

                                            @if($event->speakers && count($event->speakers) > 0)
                                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                                    @foreach($event->speakers as $speaker)
                                                        <div
                                                            class="bg-gradient-to-br from-gray-50 to-blue-50/30 rounded-2xl p-6 border border-gray-200/50 hover:shadow-lg transition-all duration-300 hover:-translate-y-1">
                                                            <div class="flex items-start gap-4">
                                                                <div
                                                                    class="w-16 h-16 rounded-2xl bg-gradient-to-br from-primary/20 to-primary/5 overflow-hidden flex-shrink-0 flex items-center justify-center">
                                                                    @if($speaker['photo'])
                                                                        <img src="{{ $speaker['photo'] }}" alt="{{ $speaker['name'] }}"
                                                                            class="w-full h-full object-cover rounded-2xl">
                                                                    @else
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                                            viewBox="0 0 24 24" fill="none" stroke="primary"
                                                                            stroke-width="2" stroke-linecap="round"
                                                                            stroke-linejoin="round">
                                                                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2" />
                                                                            <circle cx="12" cy="7" r="4" />
                                                                        </svg>
                                                                    @endif
                                                                </div>
                                                                <div class="flex-1">
                                                                    <h3 class="font-bold text-lg text-gray-900 mb-1">
                                                                        {{ $speaker['name'] }}
                                                                    </h3>
                                                                    <p class="text-primary font-semibold text-sm mb-2">
                                                                        {{ $speaker['topic'] }}
                                                                    </p>
                                                                    <p class="text-gray-600 text-sm leading-relaxed">
                                                                        {{ $speaker['bio'] }}
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            @else
                                                <div class="text-center py-12">
                                                    <div
                                                        class="w-20 h-20 bg-gradient-to-r from-primary/10 to-primary/5 rounded-2xl flex items-center justify-center mx-auto mb-4">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32"
                                                            viewBox="0 0 24 24" fill="none" stroke="primary"
                                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                            <circle cx="12" cy="12" r="10" />
                                                            <path d="M12 6v6l4 2" />
                                                        </svg>
                                                    </div>
                                                    <h3 class="text-lg font-semibold text-gray-900 mb-2">Speakers Coming Soon
                                                    </h3>
                                                    <p class="text-gray-600">Speakers akan diumumkan segera...</p>
                                                </div>
                                            @endif
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- Contact Information -->
                        @if($event->contact_info)
                            <div
                                class="bg-white rounded-3xl shadow-xl border border-gray-200/50 p-4 sm:p-8 relative overflow-hidden">
                                <div
                                    class="absolute bottom-0 right-0 w-16 h-16 sm:w-32 sm:h-32 bg-gradient-to-tl from-primary/10 to-transparent rounded-full translate-y-8 sm:translate-y-16 translate-x-8 sm:translate-x-16">
                                </div>
                                <div class="relative">
                                    <div class="flex items-center gap-3 mb-6">
                                        <div
                                            class="w-12 h-12 bg-gradient-to-r from-primary to-[#5a7ca3] rounded-xl flex items-center justify-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round">
                                                <path
                                                    d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z" />
                                            </svg>
                                        </div>
                                        <h3 class="text-xl font-bold text-gray-900">Informasi Kontak</h3>
                                    </div>
                                    <div class="space-y-3">
                                        @foreach($event->contact_info as $contact)
                                            <div class="flex items-center gap-3 p-3 bg-gray-50/80 rounded-xl">
                                                <div
                                                    class="w-8 h-8 bg-primary/10 rounded-lg flex items-center justify-center flex-shrink-0">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                        viewBox="0 0 24 24" fill="none" stroke="primary"
                                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                        <path d="M9 11a3 3 0 1 0 6 0a3 3 0 0 0-6 0" />
                                                        <path
                                                            d="M17.657 16.657L13.414 20.9a1.998 1.998 0 0 1-2.827 0l-4.244-4.243a8 8 0 1 1 11.314 0z" />
                                                    </svg>
                                                </div>
                                                <p class="text-gray-700 font-medium">{{ $contact }}</p>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Back Button - Fixed Position Bottom Left -->
    <div class="fixed bottom-4 left-4 sm:bottom-6 sm:left-6 z-50 w-auto">
        <a wire:navigate href="{{ route('client.events') }}"
            class="inline-flex items-center gap-2 bg-white/95 backdrop-blur-sm hover:bg-white px-3 py-2 sm:px-4 sm:py-3 rounded-full shadow-lg hover:shadow-xl text-gray-700 hover:text-gray-900 transition-all duration-300 transform hover:scale-105 active:scale-95 group border border-white/20 text-xs sm:text-sm">
            <div class="rounded-full transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg"
                    class="h-5 w-5 group-hover:-translate-x-1 transition-transform duration-300" width="24" height="24"
                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round">
                    <path d="M19 12H5M12 19l-7-7 7-7" />
                </svg>
            </div>
            <span class="font-semibold">Kembali</span>
        </a>
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