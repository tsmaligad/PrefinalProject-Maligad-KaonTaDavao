<?php

namespace Database\Seeders;

use App\Models\District;
use App\Models\Dish;
use App\Models\Eatery;
use App\Models\Feature;
use App\Models\Permit;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class EaterySeeder extends Seeder
{
    public function run(): void
    {
        $name = 'Carinderia ni Maligad';

        $eatery = Eatery::create([
            'district_id' => District::where('name', 'Poblacion')->firstOrFail()->id,
            'name' => $name,
            'slug' => Str::slug($name),
            'address' => 'San Pedro St., Poblacion, Davao City',
            'price_range' => 'budget',
            'specialty' => 'Tinolang Manok',
            'is_open' => true,
        ]);

        $featureIds = Feature::whereIn('name', [
            'Suki ni Maligad',
            'Budget Meal',
        ])->pluck('id')->all();

        $eatery->features()->sync($featureIds);

        $eatery->permit()->create([
            'permit_no' => 'DVO-2026-0916',
            'expires_on' => '2027-09-16',
        ]);

        $eatery->dishes()->createMany([
            [
                'name' => 'Tinolang Manok',
                'price' => 85.00,
                'is_bestseller' => true,
            ],
            [
                'name' => 'Kinilaw na Tuna',
                'price' => 120.00,
                'is_bestseller' => false,
            ],
            [
                'name' => 'Durian Shake',
                'price' => 75.00,
                'is_bestseller' => false,
            ],
        ]);

        $openEateries = Eatery::factory()->count(11)->create();

        $closedEateries = Eatery::factory()
            ->closed()
            ->count(3)
            ->create();

        $otherEateries = $openEateries->concat($closedEateries);

        $allFeatureIds = Feature::pluck('id')->all();

        foreach ($otherEateries as $index => $otherEatery) {
            $otherEatery->features()->attach(
                fake()->randomElements(
                    $allFeatureIds,
                    fake()->numberBetween(1, 3)
                )
            );

            $expiresOn = $index === 0
                ? now()->subYear()->toDateString()
                : now()->addYear()->toDateString();

            Permit::factory()->create([
                'eatery_id' => $otherEatery->id,
                'expires_on' => $expiresOn,
            ]);

            Dish::factory()
                ->count(fake()->numberBetween(2, 5))
                ->create([
                    'eatery_id' => $otherEatery->id,
                ]);
        }
    }
}
