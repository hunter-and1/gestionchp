<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;
use Carbon\Carbon;

class ChpAgentDetailsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('chp_agent_details')->insert([
            [
                'agent_id' => 1, // Assuming John Doe is CHP with ID 1
                'recruitment_type' => '1er_recrutement',
                'affectation' => 'provisoire',
                'status' => 'stagiaire',
                'position' => null, // Since the status is stagiaire, no position is assigned
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            // Add more details for other CHP agents
        ]);
    }
}
