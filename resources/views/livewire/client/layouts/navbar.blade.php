<nav 
    class="fixed top-0 left-0 right-0 flex items-center justify-between p-3 sm:p-4 md:p-5 bg-white shadow-md z-50"
    x-data="{ isOpen: @entangle('isMenuOpen') }"
>
    <div class="text-[#343434] flex items-center">
        <div class="text-4xl sm:text-5xl font-bold pl-2 sm:pl-4 md:pl-7">
            D
        </div>
        <div class="text-3xl sm:text-4xl pl-2"> FORM</div>
        
        {{-- Desktop menu --}}
        <div class="hidden md:flex space-x-6 lg:space-x-10 pr-4 lg:pl-20">
            <a class="text-lg {{ request()->routeIs('client.home') ? 'text-[#343434] font-semibold' : 'text-gray-600 hover:text-black' }}" 
               href="{{ route('client.home') }}">
                Home
            </a>
            <a class="text-lg {{ request()->routeIs('client.events*') ? 'text-[#343434] font-semibold' : 'text-gray-600 hover:text-black' }}" 
               href="{{ route('client.events') }}">
                Events
            </a>
            <a class="text-lg {{ request()->routeIs('client.about') ? 'text-[#343434] font-semibold' : 'text-gray-600 hover:text-black' }}" 
               href="{{ route('client.about') }}">
                About
            </a>
        </div>
    </div>

    {{-- Mobile menu button --}}
    <div class="md:hidden pr-2 sm:pr-4">
        <button wire:click="toggleMenu" class="p-2 cursor-pointer">
            @if($isMenuOpen)
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-x"><path d="M18 6 6 18"/><path d="m6 6 12 12"/></svg>
            @else
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-menu"><line x1="4" x2="20" y1="12" y2="12"/><line x1="4" x2="20" y1="6" y2="6"/><line x1="4" x2="20" y1="18" y2="18"/></svg>
            @endif
        </button>
    </div>

    {{-- Mobile menu dropdown --}}
    @if($isMenuOpen)
        <div class="absolute top-full left-0 right-0 bg-white shadow-md md:hidden py-4">
            <div class="flex flex-col items-center space-y-4">
                <a 
                    class="text-lg {{ request()->routeIs('client.home') ? 'text-[#343434] font-semibold' : 'text-gray-600 hover:text-black' }}" 
                    href="{{ route('client.home') }}"
                    wire:click="toggleMenu"
                >
                    Home
                </a>
                <a 
                    class="text-lg {{ request()->routeIs('client.events*') ? 'text-[#343434] font-semibold' : 'text-gray-600 hover:text-black' }}" 
                    href="{{ route('client.events') }}"
                    wire:click="toggleMenu"
                >
                    Events
                </a>
                <a 
                    class="text-lg {{ request()->routeIs('client.about') ? 'text-[#343434] font-semibold' : 'text-gray-600 hover:text-black' }}" 
                    href="{{ route('client.about') }}"
                    wire:click="toggleMenu"
                >
                    About
                </a>
            </div>
        </div>
    @endif
</nav>