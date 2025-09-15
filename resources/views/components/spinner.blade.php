{{-- filepath: resources/views/components/spinner.blade.php --}}
<style>
    .spinner-ring {
        color: #ffffff;
    }

    .spinner-ring,
    .spinner-ring div {
        box-sizing: border-box;
    }

    .spinner-ring {
        display: inline-block;
        position: relative;
        width: 80px;
        height: 80px;
    }

    .spinner-ring div {
        box-sizing: border-box;
        display: block;
        position: absolute;
        width: 64px;
        height: 64px;
        margin: 8px;
        border: 8px solid currentColor;
        border-radius: 50%;
        animation: spinner-ring 1.2s cubic-bezier(0.5, 0, 0.5, 1) infinite;
        border-color: currentColor transparent transparent transparent;
    }

    .spinner-ring div:nth-child(1) {
        animation-delay: -0.45s;
    }

    .spinner-ring div:nth-child(2) {
        animation-delay: -0.3s;
    }

    .spinner-ring div:nth-child(3) {
        animation-delay: -0.15s;
    }

    @keyframes spinner-ring {
        0% {
            transform: rotate(0deg);
        }

        100% {
            transform: rotate(360deg);
        }
    }
</style>
<div class="spinner-ring">
    <div></div>
    <div></div>
    <div></div>
    <div></div>
</div>
