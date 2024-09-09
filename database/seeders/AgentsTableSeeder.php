<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;
use Carbon\Carbon;

class AgentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('agents')->insert([
            [
                'a_firstname' => 'John',
                'a_lastname' => 'Doe',
                'a_category' => 'CHP',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'a_firstname' => 'Jane',
                'a_lastname' => 'Smith',
                'a_category' => 'HORS-CHP',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            // Add more agents if needed
        ]);
    }
}
