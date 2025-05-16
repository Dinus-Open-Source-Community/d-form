<div class="space-y-8">
    @if ($showToday)
        <livewire:admin.components.events-catalogue
            title="Today's Events"
            timestamp="today"
            :showSeeAll="$showSeeAll"
            :useQR="$useQR"
        />
    @endif

    @if ($showOngoing)
        <livewire:admin.components.events-catalogue
            title="Ongoing Events"
            timestamp="ongoing"
            :showSeeAll="$showSeeAll"
        />
    @endif

    @if ($showUpcoming)
        <livewire:admin.components.events-catalogue
            title="Upcoming Events"
            timestamp="upcoming"
            :showSeeAll="$showSeeAll"
        />
    @endif
</div>
