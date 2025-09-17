<x-layouts.app :title="$title ?? 'Welcome'">
    {{-- Konten Khusus Client --}}
    <div class="client-layout">
        <livewire:client.layouts.navbar />
        <main class="client-main">
            {{ $slot }}
        </main>
    </div>
</x-layouts.app>