<?php

use Illuminate\Database\Seeder;

class UserDataTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'name' => 'Super admin',
                'email' => 'admin@gmail.com',
                'image' => 'admin_avatar.png',
                'password' => bcrypt('123456'),
                'role' => 0,
                'rank' => 1,
                'birthday' => '1/1/1999',
            ],
            [
                'name' => 'user',
                'email' => 'user@gmail.com',
                'image' => 'default-avatar.png',
                'password' => bcrypt('123456'),
                'role' => 3,
                'rank' => 3,
                'birthday' => '1/1/1998',
            ],
            [
                'name' => 'Danh Loi',
                'email' => 'danhloi@gmail.com',
                'image' => 'default-avatar.png',
                'password' => bcrypt('123456'),
                'role' => 2,
                'rank' => 2,
                'birthday' => '18/06/1996',
            ],
            [
                'name' => 'Thanh Phan',
                'email' => 'thanhphan@gmail.com',
                'image' => 'default-avatar.png',
                'password' => bcrypt('123456'),
                'role' => 2,
                'rank' => 2,
                'birthday' => '1/1/1998',
            ],
        ]);
    }
}
