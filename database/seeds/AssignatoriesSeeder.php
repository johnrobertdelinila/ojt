<?php


use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class AssignatoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('assignatories')->insert([
            'agency'                => 'Lorma Colleges',
            'unit'                  => 'CCSE',
            'unit_head'             => 'ELLEN MANGAOANG',
            'unit_title'            => 'Dean - OIC, CCSE',
            'created_at'            => Carbon::now('Asia/Manila'),
            'updated_at'            => Carbon::now('Asia/Manila'),
        ]);

        DB::table('assignatories')->insert([
            'agency'                => 'Lorma Colleges',
            'unit'                  => 'CCSE',
            'unit_head'             => 'JEFFREY LAYCO',
            'unit_title'            => 'Information Technology OJT Head',
            'created_at'            => Carbon::now('Asia/Manila'),
            'updated_at'            => Carbon::now('Asia/Manila'),
        ]);

        DB::table('assignatories')->insert([
            'agency'                => 'Lorma Colleges',
            'unit'                  => 'CCSE',
            'unit_head'             => 'ARDEE OCAMPO',
            'unit_title'            => 'Computer Science OJT Head',
            'created_at'            => Carbon::now('Asia/Manila'),
            'updated_at'            => Carbon::now('Asia/Manila'),
        ]);
    }
}
