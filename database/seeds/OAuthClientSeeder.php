<?php

use Illuminate\Database\Seeder;

class OAuthClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('oauth_clients')->truncate();
        DB::table('oauth_clients')->insert([
            'id' => '06742e6b9c7bffb59ed8f4ae4940df4f',
            'secret' => 'secret',
            'name' => 'AngularApp'
        ]);
    }
}
