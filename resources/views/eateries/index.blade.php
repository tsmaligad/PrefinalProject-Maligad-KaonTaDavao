@extends('layouts.app')

@section('title', 'Eateries | Kaon Ta! Davao')

@section('content')
    <div class="mb-8 flex flex-wrap items-center justify-between gap-4">
        <div>
            <h1 class="text-3xl font-extrabold">Explore Eateries</h1>
            <p class="mt-2 text-stone-600">Discover where to eat in Davao City.</p>
        </div>

        <a href="{{ route('eateries.create') }}" class="rounded-xl bg-orange-700 px-5 py-3 font-semibold text-white hover:bg-orange-800">
            Add Eatery
        </a>
    </div>

    <form method="GET" action="{{ route('eateries.index') }}" class="mb-8 grid grid-cols-1 gap-4 rounded-2xl bg-white p-6 shadow-sm md:grid-cols-4">
        <div>
            <label for="q" class="mb-2 block text-sm font-semibold">Search</label>
            <input type="search" id="q" name="q" value="{{ request('q') }}" placeholder="Name or specialty" class="w-full rounded-lg border border-stone-300 px-3 py-3">
        </div>

        <div>
            <label for="district" class="mb-2 block text-sm font-semibold">District</label>
            <select id="district" name="district" class="w-full rounded-lg border border-stone-300 px-3 py-3">
                <option value="">All districts</option>
                @foreach ($districts as $district)
                    <option value="{{ $district->id }}" @selected(request('district') == $district->id)>
                        {{ $district->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label for="feature" class="mb-2 block text-sm font-semibold">Feature</label>
            <select id="feature" name="feature" class="w-full rounded-lg border border-stone-300 px-3 py-3">
                <option value="">All features</option>
                @foreach ($features as $feature)
                    <option value="{{ $feature->name }}" @selected(request('feature') == $feature->name)>
                        {{ $feature->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="flex items-end gap-2">
            <button type="submit" class="flex-1 rounded-lg bg-orange-700 px-4 py-3 font-semibold text-white hover:bg-orange-800">
                Filter
            </button>
            <a href="{{ route('eateries.index') }}" class="rounded-lg border border-stone-300 px-4 py-3 hover:bg-stone-100">
                Clear
            </a>
        </div>
    </form>

    @if ($eateries->isEmpty())
        <div class="rounded-2xl bg-white p-10 text-center text-stone-600">
            No eateries match your filters.
        </div>
    @else
        <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3">
            @foreach ($eateries as $eatery)
                <x-eatery-card :eatery="$eatery" />
            @endforeach
        </div>

        <div class="mt-8">
            {{ $eateries->links() }}
        </div>
    @endif
@endsection
