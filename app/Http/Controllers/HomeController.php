<?php

namespace App\Http\Controllers;

use App\Models\District;
use App\Models\Eatery;
use App\Models\Review;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function __invoke(): View
    {
        $eateryCount = Eatery::count();
        $districtCount = District::count();
        $reviewCount = Review::count();

        $topEateries = Eatery::query()
            ->has('reviews')
            ->with(['district', 'features'])
            ->withCount('reviews')
            ->withAvg('reviews', 'rating')
            ->orderByDesc('reviews_avg_rating')
            ->orderBy('name')
            ->limit(3)
            ->get();

        return view('home', compact(
            'eateryCount',
            'districtCount',
            'reviewCount',
            'topEateries'
        ));
    }
}
