@extends('layouts.app')

@section('title', 'Add Eatery | Kaon Ta! Davao')

@section('content')
    <div class="mx-auto max-w-3xl">
        <h1 class="mb-3 text-3xl font-extrabold">Add a New Eatery</h1>
        <p class="mb-8 text-stone-600">Enter the eatery's details, permit, and features.</p>

        <form action="{{ route('eateries.store') }}" method="POST" class="rounded-2xl bg-white p-6 shadow-sm md:p-8">
            @csrf
            @include('eateries._form')
        </form>
    </div>
@endsection
