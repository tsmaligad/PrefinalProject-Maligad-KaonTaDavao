<?php

namespace Database\Seeders;

use App\Models\Eatery;
use App\Models\Review;
use App\Models\User;
use Illuminate\Database\Seeder;

class ReviewSeeder extends Seeder
{
    public function run(): void
    {
        $eatery = Eatery::where('name', 'Carinderia ni Maligad')
            ->firstOrFail();

        $tita = User::where('email', 'tita.maligad@kaonta.test')
            ->firstOrFail();

        $trixia = User::where('email', 'maligad@kaonta.test')
            ->firstOrFail();

        $eatery->reviews()->create([
            'user_id' => $tita->id,
            'rating' => 5,
            'body' => 'Lami kaayo! Balik-balikan ni Tita Maligad.',
        ]);

        $eatery->reviews()->create([
            'user_id' => $trixia->id,
            'rating' => 5,
            'body' => 'Delicious food and affordable meals.',
        ]);

        $eatery->reviews()->create([
            'user_id' => User::whereNotIn('id', [
                $tita->id,
                $trixia->id,
            ])->firstOrFail()->id,
            'rating' => 4,
            'body' => 'The food is delicious and the service is friendly.',
        ]);

        $userIds = User::pluck('id')->all();

        $openEateries = Eatery::where('is_open', true)
            ->where('id', '!=', $eatery->id)
            ->get();

        foreach ($openEateries as $openEatery) {
            Review::factory()
                ->count(fake()->numberBetween(0, 6))
                ->create([
                    'eatery_id' => $openEatery->id,
                    'user_id' => fn () => fake()->randomElement($userIds),
                ]);
        }
    }
}
