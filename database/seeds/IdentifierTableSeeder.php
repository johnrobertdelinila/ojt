<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class IdentifierTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('identifier')->insert([
            'identifier_name' => 'CPU',
            'created_at' => Carbon::now('asia/manila'),
            'updated_at' => Carbon::now('asia/manila'),
        ]);
        DB::table('identifier')->insert([
            'identifier_name' => 'COM',
            'created_at' => Carbon::now('asia/manila'),
            'updated_at' => Carbon::now('asia/manila'),
        ]);
        DB::table('identifier')->insert([
            'identifier_name' => 'TOP',
            'created_at' => Carbon::now('asia/manila'),
            'updated_at' => Carbon::now('asia/manila'),
        ]);
    }
}
