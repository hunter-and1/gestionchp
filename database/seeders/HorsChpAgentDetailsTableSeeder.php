<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;
use Carbon\Carbon;

class HorsChpAgentDetailsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('hors_chp_agent_details')->insert([
            [
                'agent_id' => 2, // Assuming Jane Smith is HORS CHP with ID 2
                'contract_type' => 'contractuel',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            // Add more details for other HORS CHP agents
        ]);
    }
}
