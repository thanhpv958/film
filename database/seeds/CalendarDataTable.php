<?php

use Illuminate\Database\Seeder;

class CalendarDataTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('calendars')->insert([
            [
                'date_show' => '20/08/2018',
                'room_id' => 1,
                'film_id' => 1,
            ],
            [
                'date_show' => '12/07/2018',
                'room_id' => 2,
                'film_id' => 2,
            ],
            [
                'date_show' => '12/07/2018',
                'room_id' => 1,
                'film_id' => 2,
            ],
        ]);
    }
}
