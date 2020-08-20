<?php

use Illuminate\Database\Seeder;

class CommentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 1; $i <= 10; $i++){
            DB::table('comments')->insert([
                'user_id' => 1,
                'laraat_id' => $i,
                'txt_content' => 'test_comment_' . $i,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
