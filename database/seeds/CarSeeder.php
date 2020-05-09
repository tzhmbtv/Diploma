<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class CarSeeder extends Seeder
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

            for ($i = 0; $i < 20; $i++) {
                DB::table('cars')->insert([
                    'plate_number' => rand(111, 999)
                        .strtoupper($faker->randomLetter
                            .$faker->randomLetter
                            .$faker->randomLetter)
                        .rand(0, 99),
                ]);
            }
            $this->call(CarGateSeeder::class);
        }
    }
}
