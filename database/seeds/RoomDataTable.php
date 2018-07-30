<?php

use Illuminate\Database\Seeder;

class RoomDataTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('rooms')->insert([
            [
                'name' => 'Phòng chiếu 1A',
                'num_row' => 4,
                'num_seat' => 8,
                'theater_id' => 1,
            ],
            [
                'name' => 'Phòng chiếu 2B',
                'num_row' => 5,
                'num_seat' => 6,
                'theater_id' => 2,
            ],
        ]);
    }
}
