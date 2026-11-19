@extends('layouts.app')

@section('title', $eatery->name . ' | Kaon Ta! Davao')

@section('content')
    <a href="{{ route('eateries.index') }}" class="mb-6 inline-block font-semibold text-orange-700 hover:underline">
        Back to Eateries
    </a>

    <section class="mb-8 rounded-2xl bg-white p-6 shadow-sm md:p-8">
        <div class="mb-5 flex flex-wrap items-start justify-between gap-4">
            <div>
                <h1 class="mb-2 text-3xl font-extrabold">{{ $eatery->name }}</h1>

                <a href="{{ route('districts.show', $eatery->district) }}" class="font-semibold text-orange-700 hover:underline">
                    {{ $eatery->district->name }}
                </a>
            </div>

            @unless ($eatery->is_open)
                <span class="rounded-full bg-red-100 px-4 py-2 font-semibold text-red-700">Closed</span>
            @endunless
        </div>

        <p class="mb-3 text-stone-600">{{ $eatery->address }}</p>

        <p class="mb-3 font-bold text-green-700">
            {{ match ($eatery->price_range) {
                'budget' => '₱',
                'mid' => '₱₱',
                'splurge' => '₱₱₱',
                default => '',
            } }}
        </p>

        <p class="mb-4">Specialty: {{ $eatery->specialty ?? 'Not specified' }}</p>

        <div class="mb-5 flex flex-wrap gap-2">
            @foreach ($eatery->features as $feature)
                <a href="{{ route('eateries.index', ['feature' => $feature->name]) }}" class="rounded-full bg-orange-100 px-3 py-1 text-sm text-orange-800">
                    {{ $feature->name }}
                </a>
            @endforeach
        </div>

        <x-rating :rating="$eatery->reviews_avg_rating" :count="$eatery->reviews_count" />

        <div class="mt-6 flex flex-wrap gap-3">
            <a href="{{ route('eateries.edit', $eatery) }}" class="rounded-lg bg-orange-700 px-5 py-3 font-semibold text-white hover:bg-orange-800">
                Edit Eatery
            </a>

            <form action="{{ route('eateries.destroy', $eatery) }}" method="POST" onsubmit="return confirm('Delete this eatery?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="rounded-lg bg-red-600 px-5 py-3 font-semibold text-white hover:bg-red-700">
                    Delete Eatery
                </button>
            </form>
        </div>
    </section>

    <section class="mb-8 rounded-2xl bg-white p-6 shadow-sm">
        <h2 class="mb-4 text-2xl font-bold">Business Permit</h2>

        @if ($eatery->permit)
            <p class="mb-2">Permit Number: <strong>{{ $eatery->permit->permit_no }}</strong></p>
            <p>Expires on: {{ $eatery->permit->expires_on->format('F d, Y') }}</p>

            @if ($eatery->permit->expires_on->isBefore(today()))
                <p class="mt-3 font-bold text-red-600">Permit expired</p>
            @endif
        @else
            <p class="text-stone-500">No permit available.</p>
        @endif
    </section>

    <section class="mb-8 rounded-2xl bg-white p-6 shadow-sm">
        <h2 class="mb-5 text-2xl font-bold">Menu and Dishes</h2>

        <div class="divide-y divide-stone-100">
            @forelse ($eatery->dishes as $dish)
                <div class="flex flex-wrap items-center justify-between gap-3 py-4">
                    <div>
                        <h3 class="font-semibold">{{ $dish->name }}</h3>
                        @if ($dish->is_bestseller)
                            <span class="mt-1 inline-block rounded-full bg-yellow-100 px-3 py-1 text-xs font-bold text-yellow-800">
                                Bestseller
                            </span>
                        @endif
                    </div>

                    <span class="font-bold text-green-700">
                        ₱{{ number_format($dish->price, 2) }}
                    </span>
                </div>
            @empty
                <p class="py-4 text-stone-500">No dishes listed yet.</p>
            @endforelse
        </div>
    </section>

    <section class="mb-8">
        <h2 class="mb-5 text-2xl font-bold">Customer Reviews</h2>

        <div class="space-y-4">
            @forelse ($eatery->reviews as $review)
                <article class="rounded-2xl bg-white p-6 shadow-sm">
                    <div class="mb-3 flex flex-wrap items-start justify-between gap-3">
                        <div>
                            <a href="{{ route('reviewers.show', $review->user) }}" class="font-bold text-orange-700 hover:underline">
                                {{ $review->user->name }}
                            </a>

                            <div class="mt-2">
                                <x-rating :rating="$review->rating" />
                            </div>

                            <p class="mt-2 text-sm text-stone-500">
                                {{ $review->created_at->format('M d, Y') }}
                            </p>
                        </div>

                        <form action="{{ route('reviews.destroy', $review) }}" method="POST" onsubmit="return confirm('Delete this review?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="rounded-lg bg-red-50 px-3 py-2 text-sm font-semibold text-red-700 hover:bg-red-100">
                                Delete
                            </button>
                        </form>
                    </div>

                    <p class="whitespace-pre-line text-stone-700">{{ $review->body }}</p>
                </article>
            @empty
                <p class="rounded-2xl bg-white p-6 text-stone-500">No reviews yet.</p>
            @endforelse
        </div>
    </section>

    <section class="rounded-2xl bg-white p-6 shadow-sm">
        <h2 class="mb-5 text-2xl font-bold">Write a Review</h2>

        @if ($eatery->is_open)
            @if ($errors->any())
                <div class="mb-5 rounded-lg bg-red-50 p-4 text-red-700">
                    <ul class="list-inside list-disc">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('eateries.reviews.store', $eatery) }}" method="POST" class="space-y-5">
                @csrf

                <div>
                    <label for="user_id" class="mb-2 block font-semibold">Reviewer</label>
                    <select name="user_id" id="user_id" class="w-full rounded-lg border border-stone-300 p-3">
                        <option value="">Choose a reviewer</option>
                        @foreach ($users as $user)
                            <option value="{{ $user->id }}" @selected(old('user_id') == $user->id)>
                                {{ $user->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('user_id')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="rating" class="mb-2 block font-semibold">Rating</label>
                    <select name="rating" id="rating" class="w-full rounded-lg border border-stone-300 p-3">
                        <option value="">Select rating</option>
                        @for ($i = 1; $i <= 5; $i++)
                            <option value="{{ $i }}" @selected(old('rating') == $i)>
                                {{ $i }} {{ $i == 1 ? 'star' : 'stars' }}
                            </option>
                        @endfor
                    </select>
                    @error('rating')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="body" class="mb-2 block font-semibold">Review</label>
                    <textarea name="body" id="body" rows="5" class="w-full rounded-lg border border-stone-300 p-3" placeholder="Share your experience...">{{ old('body') }}</textarea>
                    @error('body')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <button type="submit" class="rounded-lg bg-orange-700 px-6 py-3 font-bold text-white hover:bg-orange-800">
                    Submit Review
                </button>
            </form>
        @else
            <p class="font-semibold text-red-600">This eatery is closed. Reviews are paused.</p>
        @endif
    </section>
@endsection
