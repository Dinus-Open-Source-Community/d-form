<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-6 px-4 sm:px-6 lg:px-10 pb-10">
    <livewire:admin.components.stat-card 
        title="Ongoing Events" 
        :count="$countOngoing" 
        bgColor="bg-gradient-to-br from-primary to-[#5a7ca3]" 
    />

    <livewire:admin.components.stat-card 
        title="Upcoming Events" 
        :count="$countUpcoming" 
        bgColor="bg-gradient-to-br from-primary to-[#5a7ca3]" 
    />

    <livewire:admin.components.stat-card 
        title="Events Completed" 
        :count="$countCompleted" 
        bgColor="bg-gradient-to-br from-primary to-[#5a7ca3]" 
    />
</div>