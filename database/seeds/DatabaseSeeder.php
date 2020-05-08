<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
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
            // Admin
            DB::table('users')->insert([
                'email'    => 'admin@chocolife.me',
                'name'     => 'life',
                'password' => Hash::make('secret'),
            ]);

            DB::table('companies')->insert([
                'short_name'    => 'Chocolife.me',
                'official_name' => 'ТОО Редпрайс',
            ]);

            DB::table('offices')->insert([
                'full_address' => 'Байзакова 280',
                'company_id'   => '1',
            ]);

            DB::table('gates')->insert([
                'name'        => 'Входные ворота',
                'office_id'  => '1',
                'client_hash' => md5('48-5F-99-BC-AF-3B'),
            ]);

            DB::table('cars')->insert([
                'plate_number'   => '444BOP02',
                'origin_gate_id' => 1,
            ]);


            DB::table('car_gate')->insert([
                'has_access' => true,
                'gate_id'    => 1,
                'car_id'     => 1,
            ]);
        }


    }
}
