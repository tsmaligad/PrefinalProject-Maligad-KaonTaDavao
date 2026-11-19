@extends('layouts.app')

@section('title', $district->name . ' | Kaon Ta! Davao')

@section('content')
    <a href="{{ route('districts.index') }}" class="mb-6 inline-block font-semibold text-orange-700 hover:underline">
        Back to Districts
    </a>

    <div class="mb-8 rounded-2xl bg-white p-8 shadow-sm">
        <h1 class="mb-3 text-3xl font-extrabold">{{ $district->name }}</h1>
        <p class="text-lg text-stone-600">
            {{ $district->reviews_count }} {{ $district->reviews_count == 1 ? 'review' : 'reviews' }} in {{ $district->name }}
        </p>
    </div>

    <h2 class="mb-6 text-2xl font-bold">Eateries in {{ $district->name }}</h2>

    <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3">
        @forelse ($eateries as $eatery)
            <x-eatery-card :eatery="$eatery" />
        @empty
            <p class="text-stone-600">No eateries in this district yet.</p>
        @endforelse
    </div>
@endsection
