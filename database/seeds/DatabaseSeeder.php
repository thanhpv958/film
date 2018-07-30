<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            TheaterDataTable::class,
            RoomDataTable::class,
            CategoriesDataTable::class,
            FilmDataTable::class,
            CalendarDataTable::class,
            UserDataTable::class,
            NewDataTable::class,
            TicketDataTable::class,
            SeatDataTable::class,
            TicketPriceDataTable::class,
            ImageUploadDataTable::class,
            CommentDataTable::class,
            CategoryTime::class,
            CategoryFilm::class,
        ]);
    }
}
