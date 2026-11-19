<?php

namespace Database\Factories;

use App\Models\Eatery;
use App\Models\Permit;
use Illuminate\Database\Eloquent\Factories\Factory;

class PermitFactory extends Factory
{
    protected $model = Permit::class;

    public function definition(): array
    {
        return [
            'eatery_id' => Eatery::factory(),
            'permit_no' => fake()->unique()->numerify('DVO-2026-#####'),
            'expires_on' => now()->addYear()->toDateString(),
        ];
    }
}
