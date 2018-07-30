<?php

use Illuminate\Database\Seeder;

class CategoryTime extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('calendar_times')->insert([
            [
                'time_show' => '9:00',
                'type_ticket' => '2D',
                'calendar_id' => 1,
            ],
            [
                'time_show' => '9:00',
                'type_ticket' => '3D',
                'calendar_id' => 1,
            ],
        ]);
    }
}
