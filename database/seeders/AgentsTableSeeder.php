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
                'a_firstname_ar' => 'جون',
                'a_lastname_ar' => 'دو',
                'a_cin' => 'AB123456',
                'a_place_of_birth' => 'City A',
                'a_place_of_birth_ar' => 'مدينة أ',
                'a_date_of_birth' => '1990-01-01',
                'a_category' => 'CHP',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'a_firstname' => 'Jane',
                'a_lastname' => 'Smith',
                'a_firstname_ar' => 'جين',
                'a_lastname_ar' => 'سميث',
                'a_cin' => 'CD789012',
                'a_place_of_birth' => 'City B',
                'a_place_of_birth_ar' => 'مدينة ب',
                'a_date_of_birth' => '1985-05-15',
                'a_category' => 'HORS-CHP',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'a_firstname' => 'Alice',
                'a_lastname' => 'Johnson',
                'a_firstname_ar' => 'أليس',
                'a_lastname_ar' => 'جونسون',
                'a_cin' => 'EF345678',
                'a_place_of_birth' => 'City C',
                'a_place_of_birth_ar' => 'مدينة ج',
                'a_date_of_birth' => '1992-11-23',
                'a_category' => 'CHP',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'a_firstname' => 'Bob',
                'a_lastname' => 'Brown',
                'a_firstname_ar' => 'بوب',
                'a_lastname_ar' => 'براون',
                'a_cin' => 'GH901234',
                'a_place_of_birth' => 'City D',
                'a_place_of_birth_ar' => 'مدينة د',
                'a_date_of_birth' => '1988-07-30',
                'a_category' => 'HORS-CHP',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'a_firstname' => 'Charlie',
                'a_lastname' => 'Davis',
                'a_firstname_ar' => 'تشارلي',
                'a_lastname_ar' => 'ديفيس',
                'a_cin' => 'IJ567890',
                'a_place_of_birth' => 'City E',
                'a_place_of_birth_ar' => 'مدينة هـ',
                'a_date_of_birth' => '1993-04-10',
                'a_category' => 'CHP',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'a_firstname' => 'Eve',
                'a_lastname' => 'Wilson',
                'a_firstname_ar' => 'إيف',
                'a_lastname_ar' => 'ويلسون',
                'a_cin' => 'KL234567',
                'a_place_of_birth' => 'City F',
                'a_place_of_birth_ar' => 'مدينة و',
                'a_date_of_birth' => '1987-12-05',
                'a_category' => 'HORS-CHP',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
