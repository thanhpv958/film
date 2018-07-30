<?php

use Illuminate\Database\Seeder;

class ImageUploadDataTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('image_uploads')->insert([
            [
                'imgupload_id' => '1',
                'imgupload_type' => 'App\Theater',
                'image' => 'deadpool2.jpg',
            ],
            [
                'imgupload_id' => '1',
                'imgupload_type' => 'App\Theater',
                'image' => 'poster.medium (7).jpg',
            ],
        ]);
    }
}
