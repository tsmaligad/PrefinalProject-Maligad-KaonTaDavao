<?php

namespace Database\Factories;

use App\Models\District;
use App\Models\Eatery;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class EateryFactory extends Factory
{
    protected $model = Eatery::class;

    public function definition(): array
    {
        $name = fake()->unique()->bothify('Davao Eatery ???-#####');

        return [
            'district_id' => District::inRandomOrder()->value('id'),
            'name' => $name,
            'slug' => Str::slug($name),
            'address' => fake()->streetAddress() . ', Davao City',
            'price_range' => fake()->randomElement(['budget', 'mid', 'splurge']),
            'specialty' => fake()->randomElement([
                'Chicken Adobo',
                'Pork Sinigang',
                'Grilled Tuna',
                'Bulalo',
                'Pancit Canton',
                'Lechon Kawali',
            ]),
            'is_open' => true,
        ];
    }

    public function closed(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_open' => false,
        ]);
    }
}
