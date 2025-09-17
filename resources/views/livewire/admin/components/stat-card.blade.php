<div x-data="{
    current: 0,
    target: @js($count),
    updateCount() {
        if (this.current < this.target) {
            const duration = 1500; // Total animation duration in ms
            const increment = Math.ceil(this.target / (duration / 20));
            let interval = setInterval(() => {
                this.current = Math.min(this.current + increment, this.target);
                if (this.current >= this.target) {
                    clearInterval(interval);
                }
            }, 20);
        }
    }
}" x-init="updateCount()"
  class="bg-gradient-to-br from-primary to-[#5a7ca3] text-white rounded-xl shadow-lg p-6 sm:p-8 flex flex-col items-center justify-center border border-white/10 transform transition-all duration-300 hover:scale-[1.02] hover:shadow-xl">
    <!-- Title -->
    <h3 class="text-lg sm:text-xl font-semibold tracking-tight mb-3">{{ $title }}</h3>
    <!-- Counter -->
    <p class="text-4xl sm:text-5xl font-bold tabular-nums" x-text="current"></p>
</div>