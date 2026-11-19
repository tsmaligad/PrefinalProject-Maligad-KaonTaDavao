@props(['rating' => null, 'count' => null])

@if ($rating !== null)
    <span {{ $attributes->class(['inline-flex flex-wrap items-center gap-1 text-sm font-semibold text-amber-700']) }}>
        <span>{{ number_format((float) $rating, 1) }} ★</span>
        @if ($count !== null)
            <span class="font-normal text-stone-500">
                ({{ $count }} {{ $count == 1 ? 'review' : 'reviews' }})
            </span>
        @endif
    </span>
@else
    <span {{ $attributes->class(['text-sm text-stone-500']) }}>
        No reviews yet
    </span>
@endif
