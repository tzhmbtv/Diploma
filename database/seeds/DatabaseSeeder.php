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

            // SZP Admin
            DB::table('users')->insert([
                'email'    => 'szp@chocolife.me',
                'name'     => 'life',
                'password' => Hash::make('secret'),
            ]);

            DB::table('companies')->insert([
                'short_name'    => 'Chocolife.me',
                'official_name' => 'ТОО Редпрайс',
            ]);

            DB::table('addresses')->insert([
                'full_address' => 'Байзакова 280',
                'company_id'   => '1',
            ]);

            DB::table('gates')->insert([
                'number'      => '1',
                'name'        => 'Входные ворота',
                'address_id'  => '1',
                'photo_uri'   => 'photo.jpg',
                'client_hash' => md5('48-5F-99-BC-AF-3B'),
            ]);
        }


    }
}
