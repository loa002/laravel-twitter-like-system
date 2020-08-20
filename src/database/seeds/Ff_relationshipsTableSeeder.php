<?php

use Illuminate\Database\Seeder;

class Ff_relationshipsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 2; $i <= 10; $i++){
            DB::table('ff_relationships')->insert([
                'following_user_id' => $i,
                'followed_user_id' => 1,
            ]);
        }
    }
}
