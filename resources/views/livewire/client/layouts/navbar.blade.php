<nav class="fixed top-0 left-0 right-0 flex items-center justify-between m-1 sm:m-2 md:m-3 p-3 sm:p-4 md:p-5 rounded-xl bg-white/20 backdrop-blur-xl shadow-2xl border border-white/30 z-50 before:absolute before:inset-0 before:rounded-xl before:bg-gradient-to-r before:from-white/10 before:to-transparent before:pointer-events-none"
    x-data="{ isOpen: @entangle('isMenuOpen') }" style="backdrop-filter: blur(20px); -webkit-backdrop-filter: blur(20px);">
    <!-- Logo Section -->
    <div class="text-primary flex items-center min-w-0">
        <div class="relative flex-shrink-0">
            <div class="text-2xl sm:text-3xl md:text-4xl lg:text-5xl font-bold pl-1 sm:pl-2 md:pl-4 lg:pl-7 relative">
                D
            </div>
        </div>
        <div class="text-lg sm:text-xl md:text-2xl lg:text-3xl pl-1 sm:pl-2 font-medium tracking-wide">FORM</div>
    </div>

    {{-- Desktop menu - Center positioned --}}
    <div class="hidden lg:flex absolute left-1/2 transform -translate-x-1/2 space-x-8 xl:space-x-12">
        <a wire:navigate
            class="relative px-4 py-2 text-base xl:text-lg font-medium transition-all duration-500 group {{ request()->routeIs('client.home') ? 'text-primary' : 'text-gray-600' }}"
            href="{{ route('client.home') }}">
            <span class="relative z-10">Home</span>
            <!-- Animated underline -->
            <span
                class="absolute bottom-0 left-0 w-0 h-0.5 bg-gradient-to-r from-primary to-[#5a7ca3] transition-all duration-500 group-hover:w-full {{ request()->routeIs('client.home') ? 'w-full' : '' }}"></span>
            <!-- Glow effect on active -->
            @if(request()->routeIs('client.home'))
                <div class="absolute inset-0 bg-gradient-to-r from-primary/10 to-[#5a7ca3]/10 rounded-xl blur-sm"></div>
            @endif
        </a>

        <a wire:navigate
            class="relative px-4 py-2 text-base xl:text-lg font-medium transition-all duration-500 group {{ request()->routeIs('client.events*') ? 'text-primary' : 'text-gray-600' }}"
            href="{{ route('client.events') }}">
            <span class="relative z-10">Events</span>
            <!-- Animated underline -->
            <span
                class="absolute bottom-0 left-0 w-0 h-0.5 bg-gradient-to-r from-primary to-[#5a7ca3] transition-all duration-500 group-hover:w-full {{ request()->routeIs('client.events*') ? 'w-full' : '' }}"></span>
            <!-- Glow effect on active -->
            @if(request()->routeIs('client.events*'))
                <div class="absolute inset-0 bg-gradient-to-r from-primary/10 to-[#5a7ca3]/10 rounded-xl blur-sm"></div>
            @endif
        </a>

        <a wire:navigate
            class="relative px-4 py-2 text-base xl:text-lg font-medium transition-all duration-500 group {{ request()->routeIs('client.about') ? 'text-primary' : 'text-gray-600' }}"
            href="{{ route('client.about') }}">
            <span class="relative z-10">About</span>
            <!-- Animated underline -->
            <span
                class="absolute bottom-0 left-0 w-0 h-0.5 bg-gradient-to-r from-primary to-[#5a7ca3] transition-all duration-500 group-hover:w-full {{ request()->routeIs('client.about') ? 'w-full' : '' }}"></span>
            <!-- Glow effect on active -->
            @if(request()->routeIs('client.about'))
                <div class="absolute inset-0 bg-gradient-to-r from-primary/10 to-[#5a7ca3]/10 rounded-xl blur-sm"></div>
            @endif
        </a>
    </div>

    {{-- Mobile menu button --}}
    <div class="lg:hidden flex-shrink-0 pr-1 sm:pr-2">
        <button wire:click="toggleMenu"
            class="p-2 sm:p-3 rounded-lg sm:rounded-xl bg-white/20 hover:bg-white/30 backdrop-blur-lg border border-white/20 transition-all duration-300 cursor-pointer shadow-lg">
            @if($isMenuOpen)
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"
                    class="text-[#466F97] sm:w-6 sm:h-6">
                    <path d="M18 6 6 18" />
                    <path d="m6 6 12 12" />
                </svg>
            @else
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"
                    class="text-[#466F97] sm:w-6 sm:h-6">
                    <line x1="4" x2="20" y1="12" y2="12" />
                    <line x1="4" x2="20" y1="6" y2="6" />
                    <line x1="4" x2="20" y1="18" y2="18" />
                </svg>
            @endif
        </button>
    </div>

    {{-- Mobile menu dropdown --}}
    @if($isMenuOpen)
        <div
            class="absolute top-full left-2 right-2 sm:left-4 sm:right-4 md:left-6 md:right-6 bg-white/10 backdrop-blur-xl shadow-2xl border border-white/20 lg:hidden py-4 sm:py-6 mt-2 rounded-xl sm:rounded-2xl before:absolute before:inset-0 before:rounded-xl before:bg-gradient-to-b before:from-white/20 before:to-white/5 before:pointer-events-none" style="backdrop-filter: blur(25px); -webkit-backdrop-filter: blur(25px);">
            <div class="flex flex-col items-center space-y-3 sm:space-y-4 md:space-y-6 px-2 sm:px-4 relative z-10">
                <a class="text-base sm:text-lg font-medium transition-all duration-300 px-4 sm:px-6 py-2 sm:py-3 rounded-lg sm:rounded-xl w-full max-w-xs text-center backdrop-blur-lg border border-white/20 {{ request()->routeIs('client.home') ? 'text-primary bg-primary/80 shadow-xl' : 'text-primary hover:text-black hover:bg-white/60 bg-white' }}"
                    href="{{ route('client.home') }}" wire:click="toggleMenu" wire:navigate>
                    Home
                </a>
                <a class="text-base sm:text-lg font-medium transition-all duration-300 px-4 sm:px-6 py-2 sm:py-3 rounded-lg sm:rounded-xl w-full max-w-xs text-center backdrop-blur-lg border border-white/20 {{ request()->routeIs('client.events*') ? 'text-primary bg-primary/80 shadow-xl' : 'text-primary hover:text-black hover:bg-white/60 bg-white' }}"
                    href="{{ route('client.events') }}" wire:click="toggleMenu" wire:navigate>
                    Events
                </a>
                <a class="text-base sm:text-lg font-medium transition-all duration-300 px-4 sm:px-6 py-2 sm:py-3 rounded-lg sm:rounded-xl w-full max-w-xs text-center backdrop-blur-lg border border-white/20 {{ request()->routeIs('client.about') ? 'text-primary bg-primary/80 shadow-xl' : 'text-primary hover:text-black hover:bg-white/60 bg-white' }}"
                    href="{{ route('client.about') }}" wire:click="toggleMenu" wire:navigate>
                    About
                </a>
            </div>
        </div>
    @endif
</nav>