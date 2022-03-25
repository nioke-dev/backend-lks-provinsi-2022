<?php

namespace Database\Seeders;

use App\Models\Regionals;
use App\Models\Societies;
use App\Models\Spot_vaccines;
use App\Models\Spots;
use App\Models\Status_vaccine;
use App\Models\User;
use App\Models\Vaccines;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Regionals::factory(10)->create();
        Societies::factory(10)->create();
        Vaccines::create(
            [
                'name' => 'Sinovac'
            ]
        );
        Vaccines::create(
            [
                'name' => 'AstraZeneca'
            ]
        );
        Vaccines::create(
            [
                'name' => 'Moderna'
            ]
        );
        Vaccines::create(
            [
                'name' => 'Pfizer'
            ]
        );
        Vaccines::create(
            [
                'name' => 'Sinnopharm'
            ]
        );


        Spots::create(
            [
                'regional_id' => '1',
                'name' => 'Rumah Sakit Pelita',
                'address' => 'Jalan Suroyo No 86 Kota Probolinggo',
                'serve' => 3,
                'capacity' => 15,
            ],
        );
        Spots::create(
            [
                'regional_id' => '2',
                'name' => 'Rumah Sakit Sejahtera',
                'address' => 'Jalan Ahmad Yani No 86 Kota Probolinggo',
                'serve' => 3,
                'capacity' => 15,
            ],
        );

        Status_vaccine::create([
            'vaccine_id' => 1,
            'spot_id' => 1,
            'Sinovac' => true,
            'AstraZeneca' => true,
            'Moderna' => true,
            'Pfizer' => true,
            'Sinnopharm' => true,
        ]);
        Status_vaccine::create([
            'vaccine_id' => 1,
            'spot_id' => 2,
            'Sinovac' => true,
            'AstraZeneca' => true,
            'Moderna' => true,
            'Pfizer' => true,
            'Sinnopharm' => true,
        ]);


        Spot_vaccines::create([
            'spot_id' => 2,
            'vaccine_id' => 1,
            'status_vaccine_id' => 2
        ]);
        Spot_vaccines::create([
            'spot_id' => 1,
            'vaccine_id' => 1,
            'status_vaccine_id' => 1
        ]);
    }
}
