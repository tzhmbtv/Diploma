<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;

class CarGateSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        if (App::environment() === 'local') //development
        {
            $faker = Faker\Factory::create();

            for ($i = 0; $i < 15; $i++) {
                try {
                    DB::table('car_gate')->insert([
                        'has_access' => $faker->boolean,
                        'gate_id'    => rand(1,10),
                        'car_id'     => rand(1,20),
                    ]);
                } catch (Exception $exception) {
                    continue;
                }

            }
        }


    }
}
