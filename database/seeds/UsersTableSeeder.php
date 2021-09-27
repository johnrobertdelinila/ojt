<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'id' => 1,
            'student_id' => '000000',
            'name' => 'ADMINISTRATOR',
            'position' => 'ADMINISTRATOR STAFF',
            'agency' => 'ADMIN',
            'signature' => '',
            'email' => 'ADMIN',
            'password' => Hash::make('admin'),
            'utype' => 'admin',
            'status' => 'Active',
            'gender' => 'Male',
            // 'image_photo' => 'prince.jpg',
            'created_at' => Carbon::now('asia/manila'),
            'updated_at' => Carbon::now('asia/manila'),
        ]);
    }
}
