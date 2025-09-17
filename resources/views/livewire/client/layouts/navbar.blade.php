<nav class="fixed left-0 right-0 top-0 z-50 m-1 flex items-center justify-between rounded-xl border border-white/30 bg-white/20 p-3 shadow-2xl backdrop-blur-xl before:pointer-events-none before:absolute before:inset-0 before:rounded-xl before:bg-gradient-to-r before:from-white/10 before:to-transparent sm:m-2 sm:p-4 md:m-3 md:p-5"
    style="backdrop-filter: blur(20px); -webkit-backdrop-filter: blur(20px);" x-data="{ isOpen: @entangle('isMenuOpen') }">
    <!-- Logo Section -->
    <div class="text-primary flex min-w-0 items-center">
        <div class="relative flex-shrink-0">
            <div class="relative pl-1 text-2xl font-bold sm:pl-2 sm:text-3xl md:pl-4 md:text-4xl lg:pl-7 lg:text-5xl">
                D
            </div>
        </div>
        <div class="pl-1 text-lg font-medium tracking-wide sm:pl-2 sm:text-xl md:text-2xl lg:text-3xl">FORM</div>
    </div>

    {{-- Desktop menu - Center positioned --}}
    <div class="absolute left-1/2 hidden -translate-x-1/2 transform space-x-8 lg:flex xl:space-x-12">
        <a class="{{ request()->routeIs('client.home') ? 'text-primary' : 'text-gray-600' }} group relative px-4 py-2 text-base font-medium transition-all duration-500 xl:text-lg"
            href="{{ route('client.home') }}" wire:navigate>
            <span class="relative z-10">Home</span>
            <!-- Animated underline -->
            <span
                class="from-primary {{ request()->routeIs('client.home') ? 'w-full' : '' }} absolute bottom-0 left-0 h-0.5 w-0 bg-gradient-to-r to-[#5a7ca3] transition-all duration-500 group-hover:w-full"></span>
            <!-- Glow effect on active -->
            @if (request()->routeIs('client.home'))
                <div class="from-primary/10 absolute inset-0 rounded-xl bg-gradient-to-r to-[#5a7ca3]/10 blur-sm"></div>
            @endif
        </a>

        <a class="{{ request()->routeIs('client.events*') ? 'text-primary' : 'text-gray-600' }} group relative px-4 py-2 text-base font-medium transition-all duration-500 xl:text-lg"
            href="{{ route('client.events') }}" wire:navigate>
            <span class="relative z-10">Events</span>
            <!-- Animated underline -->
            <span
                class="from-primary {{ request()->routeIs('client.events*') ? 'w-full' : '' }} absolute bottom-0 left-0 h-0.5 w-0 bg-gradient-to-r to-[#5a7ca3] transition-all duration-500 group-hover:w-full"></span>
            <!-- Glow effect on active -->
            @if (request()->routeIs('client.events*'))
                <div class="from-primary/10 absolute inset-0 rounded-xl bg-gradient-to-r to-[#5a7ca3]/10 blur-sm"></div>
            @endif
        </a>

        <a class="{{ request()->routeIs('client.recruitment') ? 'text-primary' : 'text-gray-600' }} group relative px-4 py-2 text-base font-medium transition-all duration-500 xl:text-lg"
            href="{{ route('client.recruitment') }}" wire:navigate>
            <span class="relative z-10">Recruitment</span>
            <!-- Animated underline -->
            <span
                class="from-primary {{ request()->routeIs('client.recruitment') ? 'w-full' : '' }} absolute bottom-0 left-0 h-0.5 w-0 bg-gradient-to-r to-[#5a7ca3] transition-all duration-500 group-hover:w-full"></span>
            <!-- Glow effect on active -->
            @if (request()->routeIs('client.recruitment'))
                <div class="from-primary/10 absolute inset-0 rounded-xl bg-gradient-to-r to-[#5a7ca3]/10 blur-sm"></div>
            @endif
        </a>

        <a class="{{ request()->routeIs('client.about') ? 'text-primary' : 'text-gray-600' }} group relative px-4 py-2 text-base font-medium transition-all duration-500 xl:text-lg"
            href="{{ route('client.about') }}" wire:navigate>
            <span class="relative z-10">About</span>
            <!-- Animated underline -->
            <span
                class="from-primary {{ request()->routeIs('client.about') ? 'w-full' : '' }} absolute bottom-0 left-0 h-0.5 w-0 bg-gradient-to-r to-[#5a7ca3] transition-all duration-500 group-hover:w-full"></span>
            <!-- Glow effect on active -->
            @if (request()->routeIs('client.about'))
                <div class="from-primary/10 absolute inset-0 rounded-xl bg-gradient-to-r to-[#5a7ca3]/10 blur-sm"></div>
            @endif
        </a>
    </div>

    {{-- Mobile menu button --}}
    <div class="flex-shrink-0 pr-1 sm:pr-2 lg:hidden">
        <button
            class="cursor-pointer rounded-lg border border-white/20 bg-white/20 p-2 shadow-lg backdrop-blur-lg transition-all duration-300 hover:bg-white/30 sm:rounded-xl sm:p-3"
            wire:click="toggleMenu">
            @if ($isMenuOpen)
                <svg class="text-[#466F97] sm:h-6 sm:w-6" xmlns="http://www.w3.org/2000/svg" width="20"
                    height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"
                    stroke-linecap="round" stroke-linejoin="round">
                    <path d="M18 6 6 18" />
                    <path d="m6 6 12 12" />
                </svg>
            @else
                <svg class="text-[#466F97] sm:h-6 sm:w-6" xmlns="http://www.w3.org/2000/svg" width="20"
                    height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"
                    stroke-linecap="round" stroke-linejoin="round">
                    <line x1="4" x2="20" y1="12" y2="12" />
                    <line x1="4" x2="20" y1="6" y2="6" />
                    <line x1="4" x2="20" y1="18" y2="18" />
                </svg>
            @endif
        </button>
    </div>

    {{-- Mobile menu dropdown --}}
    @if ($isMenuOpen)
        <div class="absolute left-2 right-2 top-full mt-2 rounded-xl border border-white/20 bg-white/10 py-4 shadow-2xl backdrop-blur-xl before:pointer-events-none before:absolute before:inset-0 before:rounded-xl before:bg-gradient-to-b before:from-white/20 before:to-white/5 sm:left-4 sm:right-4 sm:rounded-2xl sm:py-6 md:left-6 md:right-6 lg:hidden"
            style="backdrop-filter: blur(25px); -webkit-backdrop-filter: blur(25px);">
            <div class="relative z-10 flex flex-col items-center space-y-3 px-2 sm:space-y-4 sm:px-4 md:space-y-6">
                <a class="{{ request()->routeIs('client.home') ? 'text-primary bg-primary/80 shadow-xl' : 'text-primary hover:text-black hover:bg-white/60 bg-white' }} w-full max-w-xs rounded-lg border border-white/20 px-4 py-2 text-center text-base font-medium backdrop-blur-lg transition-all duration-300 sm:rounded-xl sm:px-6 sm:py-3 sm:text-lg"
                    href="{{ route('client.home') }}" wire:click="toggleMenu" wire:navigate>
                    Home
                </a>
                <a class="{{ request()->routeIs('client.events*') ? 'text-primary bg-primary/80 shadow-xl' : 'text-primary hover:text-black hover:bg-white/60 bg-white' }} w-full max-w-xs rounded-lg border border-white/20 px-4 py-2 text-center text-base font-medium backdrop-blur-lg transition-all duration-300 sm:rounded-xl sm:px-6 sm:py-3 sm:text-lg"
                    href="{{ route('client.events') }}" wire:click="toggleMenu" wire:navigate>
                    Events
                </a>
                <a class="{{ request()->routeIs('client.recruitment') ? 'text-primary bg-primary/80 shadow-xl' : 'text-primary hover:text-black hover:bg-white/60 bg-white' }} w-full max-w-xs rounded-lg border border-white/20 px-4 py-2 text-center text-base font-medium backdrop-blur-lg transition-all duration-300 sm:rounded-xl sm:px-6 sm:py-3 sm:text-lg"
                    href="{{ route('client.recruitment') }}" wire:click="toggleMenu" wire:navigate>
                    Recruitment
                </a>
                <a class="{{ request()->routeIs('client.about') ? 'text-primary bg-primary/80 shadow-xl' : 'text-primary hover:text-black hover:bg-white/60 bg-white' }} w-full max-w-xs rounded-lg border border-white/20 px-4 py-2 text-center text-base font-medium backdrop-blur-lg transition-all duration-300 sm:rounded-xl sm:px-6 sm:py-3 sm:text-lg"
                    href="{{ route('client.about') }}" wire:click="toggleMenu" wire:navigate>
                    About
                </a>
            </div>
        </div>
    @endif
</nav>
