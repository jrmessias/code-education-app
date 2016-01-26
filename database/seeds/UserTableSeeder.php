<?php

use Illuminate\Database\Seeder;
use JrMessias\Entities\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();
        factory(User::class)->create([
            'name' => 'Júnior Messias',
            'email' => 'jrmessias@gmail.com',
            'password' => bcrypt(123456),
            'remember_token' => str_random(10),
        ]);

        factory(User::class)->create([
            'name' => 'Wesley',
            'email' => 'wesleywillians@gmail.com',
            'password' => bcrypt(123456),
            'remember_token' => str_random(10),
        ]);

        factory(User::class, 10)->create();
    }
}
