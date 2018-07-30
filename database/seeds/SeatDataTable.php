<?php

use Illuminate\Database\Seeder;

class SeatDataTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('seats')->insert([
            [
                'name' => 'Ghế 1',
                'ticket_id' => 1,
            ],
            [
                'name' => 'Ghế 2',
                'ticket_id' => 2,
            ],
            [
                'name' => 'Ghế 3',
                'ticket_id' => 1,
            ],
        ]);
    }
}
