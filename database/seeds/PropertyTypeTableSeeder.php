<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class PropertyTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('property_type')->insert([
            'property_type_name' => 'Land Improvements',
            'property_life_span' => '10',
            'property_category' => '1',
            'created_at' => Carbon::now('asia/manila'),
            'updated_at' => Carbon::now('asia/manila'),
        ]);
        DB::table('property_type')->insert([
            'property_type_name' => 'Runways/taxiways',
            'property_life_span' => '20',
            'property_category' => '1',
            'created_at' => Carbon::now('asia/manila'),
            'updated_at' => Carbon::now('asia/manila'),
        ]);
        DB::table('property_type')->insert([
            'property_type_name' => 'Railways',
            'property_life_span' => '40',
            'property_category' => '1',
            'created_at' => Carbon::now('asia/manila'),
            'updated_at' => Carbon::now('asia/manila'),
        ]);
        DB::table('property_type')->insert([
            'property_type_name' => 'Electrification, Power and Energy Structures',
            'property_life_span' => '10',
            'property_category' => '1',
            'created_at' => Carbon::now('asia/manila'),
            'updated_at' => Carbon::now('asia/manila'),
        ]);
        DB::table('property_type')->insert([
            'property_type_name' => 'Wood',
            'property_life_span' => '10',
            'property_category' => '2',
            'created_at' => Carbon::now('asia/manila'),
            'updated_at' => Carbon::now('asia/manila'),
        ]);
        DB::table('property_type')->insert([
            'property_type_name' => 'Mixed',
            'property_life_span' => '20',
            'property_category' => '2',
            'created_at' => Carbon::now('asia/manila'),
            'updated_at' => Carbon::now('asia/manila'),
        ]);
        DB::table('property_type')->insert([
            'property_type_name' => 'Concrete',
            'property_life_span' => '30',
            'property_category' => '2',
            'created_at' => Carbon::now('asia/manila'),
            'updated_at' => Carbon::now('asia/manila'),
        ]);
        DB::table('property_type')->insert([
            'property_type_name' => 'Land',
            'property_life_span' => '10',
            'property_category' => '3',
            'created_at' => Carbon::now('asia/manila'),
            'updated_at' => Carbon::now('asia/manila'),
        ]);
        DB::table('property_type')->insert([
            'property_type_name' => 'Building Wood',
            'property_life_span' => '10',
            'property_category' => '3',
            'created_at' => Carbon::now('asia/manila'),
            'updated_at' => Carbon::now('asia/manila'),
        ]);
        DB::table('property_type')->insert([
            'property_type_name' => 'Building Mixed',
            'property_life_span' => '20',
            'property_category' => '3',
            'created_at' => Carbon::now('asia/manila'),
            'updated_at' => Carbon::now('asia/manila'),
        ]);
        DB::table('property_type')->insert([
            'property_type_name' => 'Building Concrete',
            'property_life_span' => '30',
            'property_category' => '3',
            'created_at' => Carbon::now('asia/manila'),
            'updated_at' => Carbon::now('asia/manila'),
        ]);
        DB::table('property_type')->insert([
            'property_type_name' => 'Office Equipment',
            'property_life_span' => '5',
            'property_category' => '4',
            'created_at' => Carbon::now('asia/manila'),
            'updated_at' => Carbon::now('asia/manila'),
        ]);
        DB::table('property_type')->insert([
            'property_type_name' => 'Furnitures and Fixtures',
            'property_life_span' => '10',
            'property_category' => '4',
            'created_at' => Carbon::now('asia/manila'),
            'updated_at' => Carbon::now('asia/manila'),
        ]);
        DB::table('property_type')->insert([
            'property_type_name' => 'IT Equipment - Hardware/Software',
            'property_life_span' => '5',
            'property_category' => '4',
            'created_at' => Carbon::now('asia/manila'),
            'updated_at' => Carbon::now('asia/manila'),
        ]);
        DB::table('property_type')->insert([
            'property_type_name' => 'Library Books',
            'property_life_span' => '5',
            'property_category' => '4',
            'created_at' => Carbon::now('asia/manila'),
            'updated_at' => Carbon::now('asia/manila'),
        ]);
        DB::table('property_type')->insert([
            'property_type_name' => 'Machineries',
            'property_life_span' => '10',
            'property_category' => '5',
            'created_at' => Carbon::now('asia/manila'),
            'updated_at' => Carbon::now('asia/manila'),
        ]);
        DB::table('property_type')->insert([
            'property_type_name' => 'Agricultural, Fishery and Forestry',
            'property_life_span' => '10',
            'property_category' => '5',
            'created_at' => Carbon::now('asia/manila'),
            'updated_at' => Carbon::now('asia/manila'),
        ]);
        DB::table('property_type')->insert([
            'property_type_name' => 'Airport Equipment',
            'property_life_span' => '10',
            'property_category' => '5',
            'created_at' => Carbon::now('asia/manila'),
            'updated_at' => Carbon::now('asia/manila'),
        ]);
        DB::table('property_type')->insert([
            'property_type_name' => 'Communication Equipment',
            'property_life_span' => '10',
            'property_category' => '5',
            'created_at' => Carbon::now('asia/manila'),
            'updated_at' => Carbon::now('asia/manila'),
        ]);
        DB::table('property_type')->insert([
            'property_type_name' => 'Construction and Heavy Equipment',
            'property_life_span' => '10',
            'property_category' => '5',
            'created_at' => Carbon::now('asia/manila'),
            'updated_at' => Carbon::now('asia/manila'),
        ]);
        DB::table('property_type')->insert([
            'property_type_name' => 'Firefighting Equipment and Accessories',
            'property_life_span' => '7',
            'property_category' => '5',
            'created_at' => Carbon::now('asia/manila'),
            'updated_at' => Carbon::now('asia/manila'),
        ]);
        DB::table('property_type')->insert([
            'property_type_name' => 'Hospital Equipment',
            'property_life_span' => '10',
            'property_category' => '5',
            'created_at' => Carbon::now('asia/manila'),
            'updated_at' => Carbon::now('asia/manila'),
        ]);
        DB::table('property_type')->insert([
            'property_type_name' => 'Medical, Dental and Laboratory Equipment',
            'property_life_span' => '10',
            'property_category' => '5',
            'created_at' => Carbon::now('asia/manila'),
            'updated_at' => Carbon::now('asia/manila'),
        ]);
        DB::table('property_type')->insert([
            'property_type_name' => 'Military and Police Equipment',
            'property_life_span' => '10',
            'property_category' => '5',
            'created_at' => Carbon::now('asia/manila'),
            'updated_at' => Carbon::now('asia/manila'),
        ]);
        DB::table('property_type')->insert([
            'property_type_name' => 'Sports Equipment',
            'property_life_span' => '10',
            'property_category' => '5',
            'created_at' => Carbon::now('asia/manila'),
            'updated_at' => Carbon::now('asia/manila'),
        ]);
        DB::table('property_type')->insert([
            'property_type_name' => 'Technical and Scientific Equipment',
            'property_life_span' => '10',
            'property_category' => '5',
            'created_at' => Carbon::now('asia/manila'),
            'updated_at' => Carbon::now('asia/manila'),
        ]);
        DB::table('property_type')->insert([
            'property_type_name' => 'Other Machineries and Equipment',
            'property_life_span' => '10',
            'property_category' => '5',
            'created_at' => Carbon::now('asia/manila'),
            'updated_at' => Carbon::now('asia/manila'),
        ]);
        DB::table('property_type')->insert([
            'property_type_name' => 'Motor Vehicles',
            'property_life_span' => '7',
            'property_category' => '6',
            'created_at' => Carbon::now('asia/manila'),
            'updated_at' => Carbon::now('asia/manila'),
        ]);
        DB::table('property_type')->insert([
            'property_type_name' => 'Trains',
            'property_life_span' => '10',
            'property_category' => '6',
            'created_at' => Carbon::now('asia/manila'),
            'updated_at' => Carbon::now('asia/manila'),
        ]);
        DB::table('property_type')->insert([
            'property_type_name' => 'Aircraft and Aircraft Ground Equipment',
            'property_life_span' => '10',
            'property_category' => '6',
            'created_at' => Carbon::now('asia/manila'),
            'updated_at' => Carbon::now('asia/manila'),
        ]);
        DB::table('property_type')->insert([
            'property_type_name' => 'Watercrafts',
            'property_life_span' => '10',
            'property_category' => '6',
            'created_at' => Carbon::now('asia/manila'),
            'updated_at' => Carbon::now('asia/manila'),
        ]);
        DB::table('property_type')->insert([
            'property_type_name' => 'Other Transportation Equipment',
            'property_life_span' => '10',
            'property_category' => '6',
            'created_at' => Carbon::now('asia/manila'),
            'updated_at' => Carbon::now('asia/manila'),
        ]);
        DB::table('property_type')->insert([
            'property_type_name' => 'Other Property, Plant and Equipment',
            'property_life_span' => '5',
            'property_category' => '7',
            'created_at' => Carbon::now('asia/manila'),
            'updated_at' => Carbon::now('asia/manila'),
        ]);
    }
}