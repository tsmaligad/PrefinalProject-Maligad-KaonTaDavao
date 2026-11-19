<?php

namespace Database\Seeders;

use App\Models\District;
use Illuminate\Database\Seeder;

class DistrictSeeder extends Seeder
{
    public function run(): void
    {
        foreach ([
            'Poblacion',
            'Talomo',
            'Agdao',
            'Buhangin',
            'Toril',
            'Calinan',
        ] as $name) {
            District::create(['name' => $name]);
        }
    }
}
