
@extends('layouts.app')

@section('title', 'Districts | Kaon Ta! Davao')

@section('content')
    <h1 class="mb-3 text-3xl font-extrabold">Davao City Districts</h1>
    <p class="mb-8 text-stone-600">Browse eateries by district.</p>

    <div class="grid grid-cols-1 gap-5 md:grid-cols-2 lg:grid-cols-3">
        @foreach ($districts as $district)
            <a href="{{ route('districts.show', $district) }}" class="rounded-2xl border border-orange-100 bg-white p-6 shadow-sm transition hover:shadow-lg">
                <h2 class="mb-3 text-2xl font-bold text-orange-700">{{ $district->name }}</h2>
                <p class="text-stone-600">
                    {{ $district->eateries_count }} {{ $district->eateries_count == 1 ? 'eatery' : 'eateries' }}
                </p>
            </a>
        @endforeach
    </div>
@endsection
