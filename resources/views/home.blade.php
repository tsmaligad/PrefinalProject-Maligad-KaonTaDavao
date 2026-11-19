@extends('layouts.app')

@section('title', "Kaon Ta! Davao – Maligad's Food Guide")

@section('content')
    <section class="mb-10 rounded-3xl bg-orange-700 px-6 py-12 text-white md:px-12">
        <p class="mb-3 font-semibold text-orange-100">Discover local Davao flavors</p>
        <h1 class="mb-4 text-4xl font-extrabold md:text-5xl">Kaon Ta! Davao</h1>
        <p class="mb-6 max-w-2xl text-orange-50">
            Find your next favorite carinderia, discover delicious dishes, and explore eateries across Davao City.
        </p>
        <a href="{{ route('eateries.index') }}" class="inline-block rounded-xl bg-white px-6 py-3 font-bold text-orange-700 hover:bg-orange-100">
            Explore Eateries
        </a>
    </section>

    <section class="mb-12 grid grid-cols-1 gap-5 sm:grid-cols-3">
        <div class="rounded-2xl bg-white p-6 shadow-sm">
            <p class="text-sm text-stone-500">Eateries</p>
            <p class="mt-2 text-4xl font-bold text-orange-700">{{ $eateryCount }}</p>
        </div>
        <div class="rounded-2xl bg-white p-6 shadow-sm">
            <p class="text-sm text-stone-500">Districts</p>
            <p class="mt-2 text-4xl font-bold text-orange-700">{{ $districtCount }}</p>
        </div>
        <div class="rounded-2xl bg-white p-6 shadow-sm">
            <p class="text-sm text-stone-500">Reviews</p>
            <p class="mt-2 text-4xl font-bold text-orange-700">{{ $reviewCount }}</p>
        </div>
    </section>

    <section>
        <div class="mb-6 flex flex-wrap items-center justify-between gap-4">
            <h2 class="text-3xl font-bold">Top Rated Eateries</h2>
            <a href="{{ route('eateries.index') }}" class="font-semibold text-orange-700 hover:underline">
                View all eateries
            </a>
        </div>

        <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3">
            @forelse ($topEateries as $eatery)
                <x-eatery-card :eatery="$eatery" />
            @empty
                <p class="text-stone-500">No rated eateries yet.</p>
            @endforelse
        </div>
    </section>
@endsection
