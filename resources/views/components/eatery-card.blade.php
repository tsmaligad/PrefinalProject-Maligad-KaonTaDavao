@props(['eatery'])

<article class="flex h-full flex-col rounded-2xl border border-amber-100 bg-white p-6 shadow-sm transition hover:shadow-lg">
    <div class="mb-3 flex items-start justify-between gap-3">
        <h3 class="text-xl font-bold text-stone-900">
            <a href="{{ route('eateries.show', $eatery) }}" class="hover:text-orange-700">
                {{ $eatery->name }}
            </a>
        </h3>

        @unless ($eatery->is_open)
            <span class="rounded-full bg-red-100 px-3 py-1 text-xs font-bold text-red-700">
                Closed
            </span>
        @endunless
    </div>

    <a href="{{ route('districts.show', $eatery->district) }}" class="mb-3 text-sm font-semibold text-orange-700 hover:underline">
        {{ $eatery->district->name }}
    </a>

    <div class="mb-3 text-lg font-bold text-green-700">
        {{ match ($eatery->price_range) {
            'budget' => '₱',
            'mid' => '₱₱',
            'splurge' => '₱₱₱',
            default => '',
        } }}
    </div>

    <p class="mb-4 text-sm text-stone-600">
        Specialty: {{ $eatery->specialty ?? 'Not specified' }}
    </p>

    <div class="mb-5 flex flex-wrap gap-2">
        @foreach ($eatery->features as $feature)
            <a href="{{ route('eateries.index', ['feature' => $feature->name]) }}" class="rounded-full bg-orange-100 px-3 py-1 text-xs font-medium text-orange-800 hover:bg-orange-200">
                {{ $feature->name }}
            </a>
        @endforeach
    </div>

    <div class="mt-auto border-t border-stone-100 pt-4">
        <x-rating :rating="$eatery->reviews_avg_rating" :count="$eatery->reviews_count" />
    </div>
</article>
