<div>
    <div class="mt-16 sm:mt-22 bg-[#343434] text-white text-center py-16 sm:py-24 md:py-32 lg:py-40 px-4">
        <div class="flex flex-col items-center justify-center text-center mb-6 sm:mb-8 space-y-4">
            <div
                class="flex flex-wrap justify-center items-center gap-2 sm:gap-3 text-3xl sm:text-5xl md:text-6xl lg:text-7xl tracking-widest uppercase">

                {{-- WELCOME TO --}}
                @livewire('client.components.animations.blur-text', [
                    'text' => 'WELCOME TO',
                    'animateBy' => 'words',
                    'direction' => 'top',
                    'class' => 'font-extrabold'
                ], key('blur-welcome'))

                <div class="flex items-center gap-2 flex-wrap sm:flex-nowrap">
                    @livewire('client.components.animations.blur-text', [
                        'text' => 'D',
                        'animateBy' => 'letters',
                        'direction' => 'top',
                        'class' => 'text-5xl sm:text-8xl md:text-9xl lg:text-[100px] font-extrabold'
                    ], key('blur-d'))

                    @livewire('client.components.animations.blur-text', [
                        'text' => 'FORM',
                        'animateBy' => 'letters',
                        'direction' => 'top',
                        'class' => 'font-normal'
                    ], key('blur-form'))
                </div>
            </div>
        </div>

        <div class="inline-block bg-white text-gray-800 font-semibold py-2 px-6 sm:px-8 md:px-10 rounded-lg shadow transition-transform duration-300 ease-out hover:scale-105 hover:bg-gray-200 hover:shadow-lg cursor-pointer">
            <a wire:navigate href="{{ route('client.events') }}" 
            >
                See All Events
            </a>
        </div>
    </div>

    <livewire:client.components.event-list :showToday="true" />
</div>
