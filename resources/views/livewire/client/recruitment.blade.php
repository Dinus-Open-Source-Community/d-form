<div class="min-h-screen bg-gradient-to-br from-gray-50 to-blue-50/30 pt-32">
    <!-- Hero Section -->
    <div class="from-primary/15 absolute inset-0 bg-gradient-to-b to-transparent"></div>
    <div class="relative overflow-hidden px-6 sm:px-8 md:px-12">
        <div class="relative py-16 sm:py-20 md:py-24">
            <div class="mx-auto max-w-4xl text-center">
                <!-- Badge -->
                <div class="bg-primary/10 mb-6 inline-flex items-center gap-2 rounded-full px-4 py-2">
                    <div class="bg-primary h-2 w-2 animate-pulse rounded-full"></div>
                    <span class="text-primary text-base font-medium">Recruitment Member Doscom</span>
                </div>

                <!-- Title -->
                <h1 class="mb-6 text-4xl font-bold leading-tight text-gray-900 sm:text-5xl md:text-6xl">
                    Pendaftaran
                    <span class="bg-primary bg-clip-text text-transparent">
                        Ditutup 🙌
                    </span>
                </h1>

                <!-- Description -->
                <p class="mx-auto max-w-3xl text-lg leading-relaxed text-gray-600 sm:text-xl">
                    Terima kasih atas antusiasme kalian, oll! ✨  
                    Pendaftaran resmi <span class="font-semibold text-primary">ditutup per 3 Oktober 2025</span>.  
                    Jangan khawatir — masih banyak kegiatan seru dari 
                    <span class="text-primary font-semibold">Doscom</span> yang bisa kamu ikuti .
                </p>
            </div>
        </div>
    </div>

{{-- Form lama disembunyikan dengan Blade comment --}}
{{-- 
<div class="mb-8 px-6 sm:px-8 md:px-12">
    @if (request()->routeIs('client.recruitment.edit'))
        @livewire('client.recruitment-edit', ['short_uuid' => request()->route('short_uuid')])
    @else
        @livewire('client.recruitment-form')
    @endif
</div>
--}}

</div>
