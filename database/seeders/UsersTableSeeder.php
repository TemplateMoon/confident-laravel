<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete();
        DB::table('users')->insert([
            ['name' => 'Jason McCreary',
             'email' => 'jmac@confidentlaravel.com',
             'password' => Hash::make('mccreaja')
            ],

            // ['name' => 'Floxy Narteh',
            //  'email' => 'floxy.narteh@thecobaltpartners.com',
            //  'password' => Hash::make('dedicated')
            // ],

        ]);
    }
}
