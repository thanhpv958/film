<?php

use Illuminate\Database\Seeder;

class CommentDataTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('comments')->insert([
            [
                'body' => 'phim rất hay và ý nghĩa',
                'parent_id' => '1',
                'user_id' => '1',
                'film_id' => '1',
            ],
            [
                'body' => 'Phim hay quá, bao giờ có phần tiếp theo nhỉ',
                'parent_id' => '2',
                'user_id' => '2',
                'film_id' => '2',
            ],
            [
                'body' => 'Phim này hài hước thật',
                'parent_id' => '2',
                'user_id' => '1',
                'film_id' => '2',
            ],
        ]);
    }
}
