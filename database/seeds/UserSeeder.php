<?php

use App\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        factory(User::class)->create([
            'name' => env('SEEDER_USER_NAME', 'Joe Test'),
            'email' => env('SEEDER_USER_EMAIL', 'joe.test@test.com'),
            'password' => Hash::make((env('SEEDER_USER_PASSWORD', 'password'))),
            ]);

    }
}
