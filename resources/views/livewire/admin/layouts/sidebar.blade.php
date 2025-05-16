<div class="min-h-screen h-full w-80 bg-[#343434] text-white flex flex-col z-40 flex-shrink-0">
  {{-- Logo --}}
  <div class="p-4 flex justify-center items-center">
    <h1 class="text-5xl font-bold">D</h1>
    <span class="ml-2 text-4xl">FORM</span>
  </div>

  {{-- Tombol New Event --}}
  <div class="p-6 flex justify-center">
    <a href="">
      <button class="bg-white/10 text-white rounded-lg py-2 px-4 text-center hover:bg-white/20 cursor-pointer">
        New Event
      </button>
    </a>
  </div>

  {{-- Menu Items --}}
  <div class="flex-grow overflow-y-auto">
    <a href="{{ route('admin.dashboard') }}" wire:navigate>
      <div
        class="flex items-center rounded-lg p-4 m-2 {{ request()->is('admin/dashboard') ? 'bg-white/10' : '' }} hover:bg-white/10 cursor-pointer">
        <span class="material-icons mr-2">menu</span>
        Dashboard
      </div>
    </a>
    <a href="" wire:navigate>
      <div
        class="flex items-center rounded-lg p-4 m-2 {{ request()->is('admin/events') ? 'bg-white/10' : '' }}  hover:bg-white/10 cursor-pointer">
        <span class="material-icons mr-2">menu</span>
        Events
      </div>
    </a>
  </div>

  {{-- User Info --}}
  <div class="mt-auto p-4 relative" x-data="{ open: false }" @click.outside="open = false">
    <div class="p-3 m-3 flex items-center rounded-md bg-white/10">
      {{-- Avatar --}}
      <div class="w-10 h-10 bg-gray-200 rounded-md mr-3 flex-shrink-0"></div>

      {{-- Username & Email --}}
      <div class="flex flex-col flex-grow w-0">
        <p class="font-medium">{{ Auth::user()->name ?? 'Admin' }}</p>
        <p class="text-xs text-gray-300 break-all w-full">{{ Auth::user()->email ?? 'example@mail.com' }}</p>
      </div>

      {{-- Menu Button --}}
      <button @click="open = !open" class="ml-2 text-2xl p-2 hover:bg-white/20 rounded-md transition">
        ⋮
      </button>

    </div>

    {{-- Dropdown Menu --}}
    <div x-show="open" x-transition
      class="absolute bottom-24 right-6 bg-white text-black rounded-md shadow-md w-32 z-50">
      <button wire:click="logout" class="w-full text-left px-4 py-2 rounded-md hover:bg-gray-200 cursor-pointer transition"
        wire:loading.attr="disabled"
        wire:loading.class="bg-gray-200 cursor-not-allowed"
        wire:loading.class.remove="cursor-pointer"
      >
        Logout
      </button>
    </div>
  </div>
</div>
