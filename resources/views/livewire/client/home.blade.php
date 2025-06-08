<style>
    /* Enhanced animations for background elements */
    @keyframes float {
        0% {
            transform: translateY(0px) rotate(0deg) scale(1);
        }

        25% {
            transform: translateY(-30px) rotate(8deg) scale(1.05);
        }

        50% {
            transform: translateY(-50px) rotate(15deg) scale(1.1);
        }

        75% {
            transform: translateY(-30px) rotate(8deg) scale(1.05);
        }

        100% {
            transform: translateY(0px) rotate(0deg) scale(1);
        }
    }

    @keyframes floatReverse {
        0% {
            transform: translateY(0px) rotate(0deg) scale(1);
        }

        25% {
            transform: translateY(40px) rotate(-10deg) scale(0.95);
        }

        50% {
            transform: translateY(60px) rotate(-20deg) scale(0.9);
        }

        75% {
            transform: translateY(40px) rotate(-10deg) scale(0.95);
        }

        100% {
            transform: translateY(0px) rotate(0deg) scale(1);
        }
    }

    @keyframes rotate {
        0% {
            transform: translate(-50%, -50%) rotate(0deg) scale(1);
        }

        25% {
            transform: translate(-50%, -50%) rotate(90deg) scale(1.05);
        }

        50% {
            transform: translate(-50%, -50%) rotate(180deg) scale(1.1);
        }

        75% {
            transform: translate(-50%, -50%) rotate(270deg) scale(1.05);
        }

        100% {
            transform: translate(-50%, -50%) rotate(360deg) scale(1);
        }
    }

    @keyframes pulse-glow {
        0% {
            opacity: 0.2;
            transform: scale(0.8);
        }

        25% {
            opacity: 0.5;
            transform: scale(1.1);
        }

        50% {
            opacity: 0.8;
            transform: scale(1.3);
        }

        75% {
            opacity: 0.5;
            transform: scale(1.1);
        }

        100% {
            opacity: 0.2;
            transform: scale(0.8);
        }
    }

    @keyframes drift {
        0% {
            transform: translateX(0px) translateY(0px) rotate(0deg);
        }

        15% {
            transform: translateX(60px) translateY(-40px) rotate(45deg);
        }

        30% {
            transform: translateX(-80px) translateY(-80px) rotate(90deg);
        }

        45% {
            transform: translateX(-120px) translateY(20px) rotate(135deg);
        }

        60% {
            transform: translateX(40px) translateY(80px) rotate(180deg);
        }

        75% {
            transform: translateX(100px) translateY(-20px) rotate(225deg);
        }

        90% {
            transform: translateX(-40px) translateY(-40px) rotate(315deg);
        }

        100% {
            transform: translateX(0px) translateY(0px) rotate(360deg);
        }
    }

    @keyframes spiral {
        0% {
            transform: translateX(0px) translateY(0px) rotate(0deg);
        }

        25% {
            transform: translateX(50px) translateY(-50px) rotate(90deg);
        }

        50% {
            transform: translateX(0px) translateY(-100px) rotate(180deg);
        }

        75% {
            transform: translateX(-50px) translateY(-50px) rotate(270deg);
        }

        100% {
            transform: translateX(0px) translateY(0px) rotate(360deg);
        }
    }

    @keyframes wave {
        0% {
            transform: translateX(0px) translateY(0px);
        }

        25% {
            transform: translateX(30px) translateY(-20px);
        }

        50% {
            transform: translateX(60px) translateY(0px);
        }

        75% {
            transform: translateX(90px) translateY(20px);
        }

        100% {
            transform: translateX(120px) translateY(0px);
        }
    }

    @keyframes morph {
        0% {
            border-radius: 50%;
            transform: scale(1) rotate(0deg);
        }

        25% {
            border-radius: 30% 70% 70% 30%;
            transform: scale(1.2) rotate(90deg);
        }

        50% {
            border-radius: 20% 80% 20% 80%;
            transform: scale(0.8) rotate(180deg);
        }

        75% {
            border-radius: 70% 30% 30% 70%;
            transform: scale(1.1) rotate(270deg);
        }

        100% {
            border-radius: 50%;
            transform: scale(1) rotate(360deg);
        }
    }

    .animate-float {
        animation: float 4s ease-in-out infinite;
    }

    .animate-float-reverse {
        animation: floatReverse 5s ease-in-out infinite;
    }

    .animate-rotate-slow {
        animation: rotate 12s linear infinite;
    }

    .animate-pulse-glow {
        animation: pulse-glow 2.5s ease-in-out infinite;
    }

    .animate-drift {
        animation: drift 8s ease-in-out infinite;
    }

    .animate-spiral {
        animation: spiral 6s ease-in-out infinite;
    }

    .animate-wave {
        animation: wave 4s ease-in-out infinite;
    }

    .animate-morph {
        animation: morph 5s ease-in-out infinite;
    }

    /* Enhanced gradient animation */
    @keyframes gradient-shift {
        0% {
            background-position: 0% 50%;
            transform: scale(1);
        }

        25% {
            background-position: 100% 0%;
            transform: scale(1.05);
        }

        50% {
            background-position: 100% 100%;
            transform: scale(1.1);
        }

        75% {
            background-position: 0% 100%;
            transform: scale(1.05);
        }

        100% {
            background-position: 0% 50%;
            transform: scale(1);
        }
    }

    .animate-gradient {
        background-size: 300% 300%;
        animation: gradient-shift 4s ease infinite;
    }

    /* Particle system */
    @keyframes particle-float {
        0% {
            transform: translateY(100vh) rotate(0deg);
            opacity: 0;
        }

        10% {
            opacity: 1;
        }

        90% {
            opacity: 1;
        }

        100% {
            transform: translateY(-100px) rotate(360deg);
            opacity: 0;
        }
    }

    .animate-particle {
        animation: particle-float 10s linear infinite;
    }
</style>

<div class="min-h-screen">
    <!-- Hero Section with Modern Design -->
    <div class="relative pt-32 min-h-screen bg-gradient-to-b from-gray-50 to-blue-50/30 overflow-hidden">
        <!-- Enhanced Background Decorative Elements -->
        <div class="absolute inset-0">
            <!-- Main floating elements with enhanced animations -->
            <div
                class="absolute top-20 right-10 w-72 h-72 bg-gradient-to-br from-primary to-transparent blur-3xl animate-float animate-pulse-glow animate-morph">
            </div>
            <div class="absolute bottom-20 left-10 w-96 h-96 bg-gradient-to-tr from-primary to-transparent blur-3xl animate-float-reverse animate-pulse-glow animate-morph"
                style="animation-delay: -1s;"></div>
            <div
                class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-[800px] h-[800px] bg-gradient-to-r from-primary/50 to-transparent rounded-full blur-3xl animate-rotate-slow">
            </div>

            <!-- Enhanced Additional Elements -->
            <div
                class="absolute top-32 left-1/4 w-48 h-48 bg-gradient-to-br from-[#5a7ca3]/40 to-transparent blur-2xl animate-drift animate-morph">
            </div>
            <div class="absolute bottom-32 right-1/4 w-64 h-64 bg-gradient-to-tl from-primary/30 to-transparent blur-2xl animate-spiral animate-pulse-glow"
                style="animation-delay: -2s;"></div>

            <!-- More dynamic floating particles -->
            <div class="absolute top-1/4 right-1/3 w-16 h-16 bg-primary/25 rounded-full blur-sm animate-float animate-morph"
                style="animation-delay: -1s; animation-duration: 3s;"></div>
            <div class="absolute bottom-1/3 left-1/3 w-20 h-20 bg-[#5a7ca3]/30 rounded-full blur-sm animate-spiral"
                style="animation-delay: -3s; animation-duration: 4s;"></div>

            <!-- New spiraling elements -->
            <div class="absolute top-16 left-1/2 w-32 h-32 bg-gradient-to-r from-primary/20 to-transparent rounded-full blur-xl animate-spiral"
                style="animation-delay: -4s;"></div>
            <div class="absolute bottom-16 right-1/2 w-40 h-40 bg-gradient-to-l from-[#5a7ca3]/25 to-transparent rounded-full blur-xl animate-drift"
                style="animation-delay: -5s;"></div>

            <!-- Morphing background shapes -->
            <div class="absolute top-40 left-20 w-80 h-80 bg-gradient-to-br from-primary/15 to-transparent blur-2xl animate-float animate-morph"
                style="animation-delay: -2.5s;"></div>
            <div class="absolute bottom-40 right-20 w-60 h-60 bg-gradient-to-tl from-[#5a7ca3]/20 to-transparent blur-2xl animate-float-reverse animate-morph"
                style="animation-delay: -3.5s;"></div>

            <!-- Particle system - floating particles -->
            <div class="absolute left-10 w-2 h-2 bg-primary/40 rounded-full animate-particle"
                style="animation-delay: 0s;"></div>
            <div class="absolute left-20 w-1 h-1 bg-[#5a7ca3]/50 rounded-full animate-particle"
                style="animation-delay: -2s;"></div>
            <div class="absolute left-32 w-3 h-3 bg-primary/30 rounded-full animate-particle"
                style="animation-delay: -4s;"></div>
            <div class="absolute right-10 w-2 h-2 bg-[#5a7ca3]/40 rounded-full animate-particle"
                style="animation-delay: -1s;"></div>
            <div class="absolute right-24 w-1 h-1 bg-primary/60 rounded-full animate-particle"
                style="animation-delay: -3s;"></div>
            <div class="absolute right-40 w-2 h-2 bg-[#5a7ca3]/35 rounded-full animate-particle"
                style="animation-delay: -5s;"></div>

            <!-- Wave-like moving elements -->
            <div class="absolute top-60 left-0 w-12 h-12 bg-primary/15 rounded-full blur-md animate-wave"
                style="animation-delay: -1s;"></div>
            <div class="absolute top-80 left-0 w-8 h-8 bg-[#5a7ca3]/20 rounded-full blur-sm animate-wave"
                style="animation-delay: -2s;"></div>
            <div class="absolute bottom-60 left-0 w-10 h-10 bg-primary/18 rounded-full blur-md animate-wave"
                style="animation-delay: -3s;"></div>
        </div>

        <!-- Main Hero Content -->
        <div class="relative z-10 px-4 sm:px-8 md:px-12 py-16 sm:py-24 md:py-32">
            <div class="max-w-6xl mx-auto text-center">
                <!-- Status Badge -->
                <div class="inline-flex items-center gap-2 bg-primary/10 backdrop-blur-sm px-6 py-3 rounded-full mb-8 border border-primary/20">
                    <div class="w-3 h-3 bg-primary rounded-full animate-pulse"></div>
                    <span class="text-primary font-semibold text-base">Platform Digital Doscom</span>
                </div>

                <!-- Animated Title -->
                <div class="flex flex-col items-center justify-center text-center mb-12 space-y-6">
                    <div class="flex flex-wrap justify-center items-center gap-4 sm:gap-6 md:gap-8">
                        {{-- WELCOME TO --}}
                        @livewire('client.components.animations.blur-text', [
                            'text' => 'WELCOME TO',
                            'animateBy' => 'words',
                            'direction' => 'top',
                            'class' => 'text-2xl sm:text-4xl md:text-5xl lg:text-6xl font-bold text-gray-900 tracking-wide'
                        ], key('blur-welcome'))

                        <div class="flex items-center gap-4 sm:gap-8 flex-wrap sm:flex-nowrap">
                            @livewire('client.components.animations.blur-text', [
                                'text' => 'D',
                                'animateBy' => 'letters',
                                'direction' => 'top',
                                'class' => 'text-5xl sm:text-8xl md:text-9xl lg:text-[120px] font-extrabold bg-gradient-to-r from-primary to-[#5a7ca3] bg-clip-text animate-gradient'
                            ], key('blur-d'))

                            @livewire('client.components.animations.blur-text', [
                                'text' => 'FORM',
                                'animateBy' => 'letters',
                                'direction' => 'top',
                                'class' => 'text-3xl sm:text-6xl md:text-7xl lg:text-8xl font-bold text-gray-900 tracking-wider'
                            ], key('blur-form'))
                        </div>
                    </div>
                </div>

                <!-- Hero Description -->
                <div class="max-w-4xl mx-auto mb-12">
                    <p class="text-lg sm:text-xl md:text-2xl text-gray-700 leading-relaxed mb-6">
                        Platform digital untuk 
                        <span class="text-primary font-semibold">absensi</span> 
                        dan 
                        <span class="text-primary font-semibold">pendaftaran</span> 
                        event
                        <span class="text-primary font-bold">Dinus Open Source Community</span>
                    </p>
                </div>

                <!-- CTA Buttons -->
                <div class="flex flex-col sm:flex-row gap-4 justify-center items-center mb-16 w-full">
                    <a wire:navigate href="{{ route('client.events') }}" 
                        class="group inline-flex items-center gap-3 bg-gradient-to-r from-primary to-[#5a7ca3] text-white font-semibold py-4 px-8 rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105 w-full sm:w-auto text-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="3" y="4" width="18" height="18" rx="2" ry="2"/>
                            <line x1="16" y1="2" x2="16" y2="6"/>
                            <line x1="8" y1="2" x2="8" y2="6"/>
                            <line x1="3" y1="10" x2="21" y2="10"/>
        </svg>
                        Lihat Event
                    </a>
                    
                    <a wire:navigate href="{{ route('client.about') }}" 
                        class="group inline-flex items-center gap-3 bg-white/80 backdrop-blur-sm text-primary font-semibold py-4 px-8 rounded-2xl shadow-lg hover:shadow-xl border border-primary/20 transition-all duration-300 transform hover:scale-105 w-full sm:w-auto text-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="12" r="10"/>
                            <path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"/>
                            <line x1="12" y1="17" x2="12.01" y2="17"/>
                        </svg>
                        Tentang D-Form
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Events Section -->
    <livewire:client.components.event-list :showToday="true" />
</div>