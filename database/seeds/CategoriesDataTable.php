<?php

use Illuminate\Database\Seeder;

class CategoriesDataTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            [
                'name' => 'Hành Động',
            ],
            [
                'name' => 'Viễn Tưởng',
            ],
            [
                'name' => 'Kinh Dị',
            ],
            [
                'name' => 'Hài Hước',
            ],
        ]);
    }
}
