<div class="bg-primary z-40 flex h-full min-h-screen w-80 flex-shrink-0 flex-col text-white">
    {{-- Logo --}}
    <div class="flex items-center justify-start p-4">
        <h1 class="text-5xl font-bold">D</h1>
        <span class="ml-2 text-4xl">FORM</span>
    </div>

    {{-- Tombol New Event --}}
    <div class="flex items-center justify-center p-4">
        <a class="flex w-full cursor-pointer items-center justify-center rounded-lg bg-white/10 px-4 py-2 text-center text-white transition-colors duration-200 ease-in-out hover:bg-white/20"
            href="{{ route('admin.events-create') }}" wire:navigate>
            <span class="material-icons mr-2 align-middle">
                add_circle
            </span>
            New Event
        </a>
    </div>

    {{-- Menu Items --}}
    <div class="flex-grow overflow-y-auto">
        <a href="{{ route('admin.dashboard') }}" wire:navigate>
            <div
                class="{{ request()->is('admin/dashboard') ? 'bg-white/10' : '' }} m-2 flex cursor-pointer items-center rounded-lg p-4 transition-colors duration-200 ease-in-out hover:bg-white/10">
                <span class="material-icons mr-2">
                    dashboard
                </span>
                Dashboard
            </div>
        </a>
        <a href="{{ route('admin.events') }}" wire:navigate>
            <div
                class="{{ request()->is('admin/events') || request()->is('admin/events/*') ? 'bg-white/10' : '' }} m-2 flex cursor-pointer items-center rounded-lg p-4 transition-colors duration-200 ease-in-out hover:bg-white/10">
                <span class="material-icons mr-2">
                    event
                </span>
                Events
            </div>
        </a>
        <a href="{{ route('admin.completed-events') }}" wire:navigate>
            <div
                class="{{ request()->is('admin/completed-events') ? 'bg-white/10' : '' }} m-2 flex cursor-pointer items-center rounded-lg p-4 transition-colors duration-200 ease-in-out hover:bg-white/10">
                <span class="material-icons mr-2">
                    event_available
                </span>
                Completed Events
            </div>
        </a>
        <a href="{{ route('admin.recruitment-convert') }}" wire:navigate>
            <div
                class="{{ request()->is('admin/recruitment-convert') ? 'bg-white/10' : '' }} m-2 flex cursor-pointer items-center rounded-lg p-4 transition-colors duration-200 ease-in-out hover:bg-white/10">
                <span class="material-icons mr-2">
                    people
                </span>
                Recruitment
            </div>
        </a>
    </div>

    {{-- User Info --}}
    <div class="relative mt-auto p-4" x-data="{ open: false }" @click.outside="open = false">
        <div class="m-3 flex items-center rounded-md bg-white/10 p-3">
            {{-- Avatar --}}
            <div
                class="mr-3 flex h-10 w-10 flex-shrink-0 items-center justify-center rounded-md bg-gray-200 text-2xl font-bold text-gray-600">
                {{ Auth::user()->name ? substr(Auth::user()->name, 0, 1) : 'A' }}
            </div>

            {{-- Username & Email --}}
            <div class="flex w-0 flex-grow flex-col">
                <p class="font-medium">{{ Auth::user()->name ?? 'Admin' }}</p>
                <p class="w-full break-all text-xs text-gray-300">{{ Auth::user()->email ?? 'example@mail.com' }}</p>
            </div>

            {{-- Menu Button --}}
            <button class="ml-2 rounded-md p-2 text-2xl transition hover:bg-white/20" @click="open = !open">
                ⋮
            </button>
        </div>

        {{-- Dropdown Menu --}}
        <div class="absolute bottom-24 right-6 z-50 w-32 rounded-md bg-white text-black shadow-md" x-show="open"
            x-transition>
            <button class="w-full cursor-pointer rounded-md px-4 py-2 text-left transition hover:bg-gray-200"
                wire:click="logout" wire:loading.attr="disabled" wire:loading.class="bg-gray-200 cursor-not-allowed"
                wire:loading.class.remove="cursor-pointer">
                Logout
            </button>
        </div>
    </div>
</div>
