<?php

namespace Database\Factories;

use App\Models\Dish;
use App\Models\Eatery;
use Illuminate\Database\Eloquent\Factories\Factory;

class DishFactory extends Factory
{
    protected $model = Dish::class;

    public function definition(): array
    {
        return [
            'eatery_id' => Eatery::factory(),
            'name' => fake()->randomElement([
                'Chicken Adobo',
                'Pork Barbecue',
                'Beef Caldereta',
                'Sinigang na Baboy',
                'Fried Bangus',
                'Pancit Bihon',
                'Garlic Chicken',
                'Tuna Kinilaw',
            ]),
            'price' => fake()->randomFloat(2, 50, 350),
            'is_bestseller' => fake()->boolean(25),
        ];
    }
}
