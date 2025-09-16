<div class="px-8 py-6 bg-white z-10">
  <div class="flex items-center text-sm text-primary/50">
    @php
      $segments = array_slice(request()->segments(), 1);
      $path = '/admin';
    @endphp

    @foreach ($segments as $index => $segment)
      @php
        if (strlen($segment) > 10) {
            $newSegment = 'Detail';
        }
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
        <span class="text-primary font-semibold">{{ $newSegment ?? $displayName }}</span>
      @else
        <a href="{{ url($path) }}" class="hover:text-primary transition-colors ease-in-out duration-200" wire:navigate>
          {{ $newSegment ?? $displayName }}
        </a>
      @endif
      @php
        $newSegment = null;
      @endphp
    @endforeach
  </div>
</div>
