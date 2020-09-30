<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 1; $i <= 10; $i++){
            DB::table('users')->insert([
                'name' => 'test_user_' . $i,
                'handle_name' => 'TEST_USER_' . $i,
                'image_picture' => 'sample.png',
                'email' => 'test_mail_' . $i . '@test.com',
                'password' => Hash::make('123456789'),
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
