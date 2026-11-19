<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEateryRequest;
use App\Http\Requests\UpdateEateryRequest;
use App\Models\District;
use App\Models\Eatery;
use App\Models\Feature;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\View\View;

class EateryController extends Controller
{
    public function index(Request $request): View
    {
        $query = Eatery::query()
            ->with(['district', 'features'])
            ->withCount('reviews')
            ->withAvg('reviews', 'rating');

        if ($request->filled('q')) {
            $search = $request->input('q');

            $query->where(function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%')
                    ->orWhere('specialty', 'like', '%' . $search . '%');
            });
        }

        if ($request->filled('district')) {
            $query->where('district_id', $request->input('district'));
        }

        if ($request->filled('feature')) {
            $query->whereHas('features', function ($query) use ($request) {
                $query->where('name', $request->input('feature'));
            });
        }

        $eateries = $query
            ->orderBy('name')
            ->paginate(6)
            ->withQueryString();

        $districts = District::orderBy('name')->get();
        $features = Feature::orderBy('name')->get();

        return view('eateries.index', compact(
            'eateries',
            'districts',
            'features'
        ));
    }

    public function create(): View
    {
        $districts = District::orderBy('name')->get();
        $features = Feature::orderBy('name')->get();

        return view('eateries.create', compact(
            'districts',
            'features'
        ));
    }

    public function store(StoreEateryRequest $request): RedirectResponse
    {
        $data = $request->validated();

        $eatery = DB::transaction(function () use ($data) {
            $eatery = Eatery::create([
                'district_id' => $data['district_id'],
                'name' => $data['name'],
                'slug' => Str::slug($data['name']),
                'address' => $data['address'],
                'price_range' => $data['price_range'],
                'specialty' => $data['specialty'] ?? null,
                'is_open' => $data['is_open'] ?? false,
            ]);

            $eatery->permit()->create([
                'permit_no' => $data['permit_no'],
                'expires_on' => $data['expires_on'],
            ]);

            $eatery->features()->sync($data['features']);

            return $eatery;
        });

        return redirect()
            ->route('eateries.show', $eatery)
            ->with('status', 'Eatery added.');
    }

    public function show(Eatery $eatery): View
    {
        $eatery->load([
            'district',
            'permit',
            'features',
            'dishes',
            'reviews' => fn ($query) => $query
                ->with('user')
                ->latest(),
        ]);

        $eatery->loadCount('reviews');
        $eatery->loadAvg('reviews', 'rating');

        $users = \App\Models\User::orderBy('name')->get();

        return view('eateries.show', compact('eatery', 'users'));
    }

    public function edit(Eatery $eatery): View
    {
        $eatery->load(['permit', 'features']);

        $districts = District::orderBy('name')->get();
        $features = Feature::orderBy('name')->get();

        return view('eateries.edit', compact(
            'eatery',
            'districts',
            'features'
        ));
    }

    public function update(
        UpdateEateryRequest $request,
        Eatery $eatery
    ): RedirectResponse {
        $data = $request->validated();

        DB::transaction(function () use ($eatery, $data) {
            $eatery->update([
                'district_id' => $data['district_id'],
                'name' => $data['name'],
                'slug' => Str::slug($data['name']),
                'address' => $data['address'],
                'price_range' => $data['price_range'],
                'specialty' => $data['specialty'] ?? null,
                'is_open' => $data['is_open'] ?? false,
            ]);

            $eatery->permit()->updateOrCreate(
                [],
                [
                    'permit_no' => $data['permit_no'],
                    'expires_on' => $data['expires_on'],
                ]
            );

            $eatery->features()->sync($data['features']);
        });

        return redirect()
            ->route('eateries.show', $eatery)
            ->with('status', 'Eatery updated.');
    }

    public function destroy(Eatery $eatery): RedirectResponse
    {
        DB::transaction(function () use ($eatery) {
            $eatery->features()->detach();
            $eatery->reviews()->delete();
            $eatery->dishes()->delete();
            $eatery->permit()->delete();
            $eatery->delete();
        });

        return redirect()
            ->route('eateries.index')
            ->with('status', 'Eatery deleted.');
    }
}
