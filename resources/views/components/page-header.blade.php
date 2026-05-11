@props(['eyebrow' => null, 'title', 'description' => null])

<section class="border-b border-slate-200 bg-white">
    <div class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8">
        @if ($eyebrow)
            <p class="text-sm font-black uppercase tracking-wide text-teal-700">{{ $eyebrow }}</p>
        @endif

        <div class="mt-2 max-w-3xl">
            <h1 class="text-3xl font-black leading-tight text-slate-950 sm:text-4xl">{{ $title }}</h1>

            @if ($description)
                <p class="mt-3 text-base leading-7 text-slate-600">{{ $description }}</p>
            @endif
        </div>
    </div>
</section>
