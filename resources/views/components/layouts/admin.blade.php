<x-layouts.app>
  <div class="flex h-screen w-full bg-gray-100">
    <livewire:admin.layouts.sidebar />
    <div class="flex flex-col flex-grow h-full">
      <livewire:admin.layouts.page-header />
      <div class="flex-grow px-6 py-4 overflow-auto">
        {{ $slot }}
      </div>
    </div>
  </div>
</x-layouts.app>
