<?php

use Illuminate\Database\Seeder;
use App\User;
use Faker\Factory;

class DatabaseSeeder extends Seeder
{
    /**
     * @var \Faker\Generator
     */
    private $faker;


    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //
        $this->faker = Factory::create();

        // Create admin
        $this->createAdmin();
    }

    /**
     * 
     * @return void
     */
    private function createAdmin()
    {
        User::create([
            'email'    => 'admin@project.com',
            'name'     => 'Admin',
            'password' => bcrypt('123456')
        ]);
    }

    /**
     * 
     * @return void
     */
    private function createUser()
    {

    }
}
