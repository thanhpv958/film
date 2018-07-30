<?php

use Illuminate\Database\Seeder;

class CategoryFilm extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('category_film')->insert([
            [
                'category_id' => 1,
                'film_id' => 1,
            ],
            [
                'category_id' => 2,
                'film_id' => 2,
            ],
        ]);
    }
}
