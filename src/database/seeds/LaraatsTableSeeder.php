<?php

use Illuminate\Database\Seeder;

class LaraatsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 1; $i <= 10; $i++){
            DB::table('laraats')->insert([
                'user_id' => $i,
                'txt_content' => 'test_txt_content_' . $i,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
