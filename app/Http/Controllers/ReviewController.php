<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreReviewRequest;
use App\Models\Eatery;
use App\Models\Review;
use Illuminate\Http\RedirectResponse;

class ReviewController extends Controller
{
    public function store(
        StoreReviewRequest $request,
        Eatery $eatery
    ): RedirectResponse {
        $data = $request->validated();

        $eatery->reviews()->create($data);

        return redirect()
            ->route('eateries.show', $eatery)
            ->with('status', 'Salamat! Review posted.');
    }

    public function destroy(Review $review): RedirectResponse
    {
        $eatery = $review->eatery;

        $review->delete();

        return redirect()
            ->route('eateries.show', $eatery)
            ->with('status', 'Review deleted.');
    }
}
