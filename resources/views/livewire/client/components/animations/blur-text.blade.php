<div>
    @if($animateBy === 'words')
        <span class="{{ $class }} blur-text-word" data-direction="{{ $direction }}">
            {{ $text }}
        </span>
    @elseif($animateBy === 'letters')
        <span class="{{ $class }}">
            @foreach(str_split($text) as $char)
                <span class="blur-text-char" data-direction="{{ $direction }}">{{ $char }}</span>
            @endforeach
        </span>
    @endif
</div>

@pushOnce('styles')
    <style>
        .blur-text-word, .blur-text-char {
            opacity: 0;
            filter: blur(5px);
            display: inline-block;
        }

        .blur-text-word[data-direction="top"],
        .blur-text-char[data-direction="top"] {
            transform: translateY(-20px);
        }

        .blur-text-word[data-direction="bottom"],
        .blur-text-char[data-direction="bottom"] {
            transform: translateY(20px);
        }

        .blur-text-word[data-direction="left"],
        .blur-text-char[data-direction="left"] {
            transform: translateX(-20px);
        }

        .blur-text-word[data-direction="right"],
        .blur-text-char[data-direction="right"] {
            transform: translateX(20px);
        }
    </style>
@endPushOnce

@pushOnce('scripts')
    <script>
        function triggerBlurTextAnimation() {
            // Animate words
            document.querySelectorAll('.blur-text-word').forEach((el, index) => {
                setTimeout(() => {
                    el.style.transition = 'opacity 0.5s ease-out, filter 0.5s ease-out, transform 0.5s ease-out';
                    el.style.opacity = 1;
                    el.style.filter = 'blur(0)';
                    el.style.transform = 'translate(0)';
                }, index * 100);
            });

            // Animate letters
            document.querySelectorAll('.blur-text-char').forEach((el, index) => {
                setTimeout(() => {
                    el.style.transition = 'opacity 0.3s ease-out, filter 0.3s ease-out, transform 0.3s ease-out';
                    el.style.opacity = 1;
                    el.style.filter = 'blur(0)';
                    el.style.transform = 'translate(0)';
                }, index * 50);
            });
        }

        document.addEventListener('DOMContentLoaded', triggerBlurTextAnimation);
        document.addEventListener('livewire:navigated', triggerBlurTextAnimation);

        document.addEventListener('livewire:navigated', function () {
            if (window.AOS) {
                window.AOS.refreshHard();
            }
        });
    </script>
@endPushOnce
