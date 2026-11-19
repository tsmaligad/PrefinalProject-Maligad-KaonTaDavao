@extends('layouts.app')

@section('title', 'Edit Eatery | Kaon Ta! Davao')

@section('content')
    <div class="mx-auto max-w-3xl">
        <h1 class="mb-3 text-3xl font-extrabold">Edit Eatery</h1>
        <p class="mb-8 text-stone-600">Update {{ $eatery->name }}.</p>

        <form action="{{ route('eateries.update', $eatery) }}" method="POST" class="rounded-2xl bg-white p-6 shadow-sm md:p-8">
            @csrf
            @method('PUT')
            @include('eateries._form')
        </form>
    </div>
@endsection
