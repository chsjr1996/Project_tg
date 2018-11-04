<?php

use Illuminate\Database\Seeder;
use App\User;
use App\UsersTypeR;
use Faker\Factory;
use Illuminate\Support\Facades\Hash;


class UsersTableSeeder extends Seeder
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
        $this->faker = Factory::create();

        // Create admin
        $this->createAdmin();

        // Create users
        $this->createUser();
    }

    /**
     * 
     * @return void
     */
    private function createAdmin()
    {
        $user = User::create([
            'email'    => 'admin@project.com',
            'name'     => 'Admin',
            'password' => Hash::make('123456')
        ]);

        UsersTypeR::create([
            'user_id' => $user->id,
            'user_type_id' => '1',
        ]);
    }

    /**
     * 
     * @return void
     */
    private function createUser()
    {
        foreach(range(1,100) as $index) {
            $data = [
                'name'           => $this->faker->name,
                'email'          => $this->faker->unique()->safeEmail,
                'password'       => Hash::make('secret')
            ];

            $user = User::create($data);

            UsersTypeR::create([
                'user_id' => $user->id,
                'user_type_id' => '3',
            ]);
        }
    }
}
