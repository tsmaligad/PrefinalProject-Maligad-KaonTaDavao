@extends('layouts.app')

@section('title', $user->name . ' | Kaon Ta! Davao')

@section('content')
    <h1 class="mb-3 text-3xl font-extrabold">{{ $user->name }}</h1>

    <p class="mb-8 text-lg text-stone-600">
        {{ $user->reviews_count }} {{ $user->reviews_count == 1 ? 'review' : 'reviews' }} written
    </p>

    <div class="space-y-5">
        @forelse ($reviews as $review)
            <article class="rounded-2xl bg-white p-6 shadow-sm">
                <a href="{{ route('eateries.show', $review->eatery) }}" class="text-xl font-bold text-orange-700 hover:underline">
                    {{ $review->eatery->name }}
                </a>

                <div class="my-3">
                    <x-rating :rating="$review->rating" />
                </div>

                <p class="whitespace-pre-line text-stone-700">{{ $review->body }}</p>

                <p class="mt-4 text-sm text-stone-500">
                    {{ $review->created_at->format('M d, Y') }}
                </p>
            </article>
        @empty
            <p class="text-stone-600">No reviews written yet.</p>
        @endforelse
    </div>
@endsection
