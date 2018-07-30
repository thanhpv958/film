<?php

use Illuminate\Database\Seeder;

class TheaterDataTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('theaters')->insert([
            [
                'name' => 'Rạp chiếu Capitol Theatre',
                'phone' => '098889999',
                'address' => 'Số 1 Cầu Giấy, Hà Nội',
                'description' => 'Rạp chiếu đẹp, tiện nghi, phù hợp mọi lứa tuổi',
            ],
            [
                'name' => 'Rạp chiếu  Historic Theater',
                'phone' => '0987654321',
                'address' => 'Số 34 Tây Sơn, Hà Nội',
                'description' => 'Rạp chiếu có giá rẻ nhất hiện nay',
            ],
        ]);
    }
}
