<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;
use Carbon\Carbon;

class RecruitmentHistoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('recruitment_history')->insert([
            [
                'agent_id' => 1, // John Doe's recruitment history (CHP)
                'event' => 'recruitment_type',
                'old_value' => '1er_recrutement',
                'new_value' => 'mutation',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'agent_id' => 2, // Jane Smith's recruitment history (HORS CHP)
                'event' => 'contract_type',
                'old_value' => 'stagiaire',
                'new_value' => 'contractuel',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            // Add more recruitment history for other agents
        ]);
    }
}
