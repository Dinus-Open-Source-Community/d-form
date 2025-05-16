<div class="grid grid-cols-1 md:grid-cols-3 gap-3 px-10 pb-10">
    <livewire:admin.components.stat-card 
        title="Ongoing Events" 
        :count="$countOngoing" 
        bgColor="bg-[#343434]" 
    />

    <livewire:admin.components.stat-card 
        title="Upcoming Events" 
        :count="$countUpcoming" 
        bgColor="bg-[#343434]" 
    />

    <livewire:admin.components.stat-card 
        title="Events Completed" 
        :count="$countCompleted" 
        bgColor="bg-[#343434]" 
    />
</div>
