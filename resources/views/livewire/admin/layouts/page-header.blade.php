<div class="px-8 py-6 bg-white z-10">
  <div class="flex items-center text-sm text-gray-500">
    @php
      $segments = array_slice(request()->segments(), 1);
      $path = '/admin';
    @endphp

    @foreach ($segments as $index => $segment)
      @php
        $path .= '/' . $segment;
        $displayName = is_numeric($segment)
            ? $events[$segment]['title'] ?? $segment
            : ucfirst(str_replace('-', ' ', $segment));
        $isLast = $index === count($segments) - 1;
      @endphp

      @if ($index > 0)
        <span class="mx-2">/</span>
      @endif

      @if ($isLast)
        <span class="text-gray-700 font-semibold">{{ $displayName }}</span>
      @else
        <a href="{{ url($path) }}" class="hover:text-gray-700" wire:navigate>
          {{ $displayName }}
        </a>
      @endif
    @endforeach
  </div>
</div>
