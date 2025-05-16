<div x-data="{
    current: 0,
    target: @js($count),
    updateCount() {
        if (this.current < this.target) {
            let interval = setInterval(() => {
                this.current++;
                if (this.current >= this.target) {
                    clearInterval(interval);
                }
            }, 20);
        }
    }
}" x-init="updateCount()"
  class="{{ $bgColor }} text-white rounded-lg p-8 flex flex-col items-center justify-center">
  <h3 class="text-xl mb-4">{{ $title }}</h3>
  <p class="text-5xl font-bold" x-text="current"></p>
</div>
