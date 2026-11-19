<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\View\View;

class ReviewerController extends Controller
{
    public function show(User $user): View
    {
        $user->loadCount('reviews');

        $reviews = $user->reviews()
            ->with('eatery')
            ->latest()
            ->get();

        return view('reviewers.show', compact('user', 'reviews'));
    }
}
