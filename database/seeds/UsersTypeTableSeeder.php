<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class UsersTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users_types')->insert([
            [
                'type'       => 'Admin',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'type'       => 'Company',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'type'       => 'User',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
        ]);
    }
}
