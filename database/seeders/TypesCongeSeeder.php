<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TypesCongeSeeder extends Seeder
{
    public function run()
    {
        // Congés administratifs
        DB::table('types_conge')->insert([
            [
                'code' => 'C.ANNUEL',
                'libelle' => 'Congé annuel',
                'description' => 'Congé administratif annuel',
                'max_jours' => 22,
                'categorie' => 'ADMINISTRATIF',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'code' => 'C.EXCEP.FAM',
                'libelle' => 'Congé exceptionnel - Raisons familiales',
                'description' => 'Congé pour raisons familiales',
                'max_jours' => 10,
                'categorie' => 'EXCEPTIONNEL',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'code' => 'C.EXCEP.MAR',
                'libelle' => 'Congé exceptionnel - Mariage',
                'description' => 'Congé pour mariage',
                'max_jours' => 10,
                'categorie' => 'EXCEPTIONNEL',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'code' => 'C.EXCEP.DEC',
                'libelle' => 'Congé exceptionnel - Décès',
                'description' => 'Congé pour décès',
                'max_jours' => 10,
                'categorie' => 'EXCEPTIONNEL',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'code' => 'C.EXCEP.EXAM',
                'libelle' => 'Congé exceptionnel - Examen/Formation',
                'description' => 'Congé pour examen ou formation',
                'max_jours' => 10,
                'categorie' => 'EXCEPTIONNEL',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'code' => 'C.EXCEP.MAND',
                'libelle' => 'Congé - Mandat public/syndical',
                'description' => 'Congé pour exercice d\'un mandat public ou syndical',
                'max_jours' => 10,
                'categorie' => 'EXCEPTIONNEL',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'code' => 'C.EXCEP.SPORT',
                'libelle' => 'Congé - Compétition sportive',
                'description' => 'Congé pour participation à une compétition sportive',
                'max_jours' => 10,
                'categorie' => 'EXCEPTIONNEL',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'code' => 'C.EXCEP.PELER',
                'libelle' => 'Congé - Pèlerinage',
                'description' => 'Congé pour pèlerinage',
                'max_jours' => 22,
                'categorie' => 'EXCEPTIONNEL',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Congés maladie
            [
                'code' => 'C.MAL.COURT',
                'libelle' => 'Congé maladie courte durée',
                'description' => 'Congé maladie de courte durée (max 180 jours sur 12 mois successifs)',
                'max_jours' => 180,
                'categorie' => 'MALADIE',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'code' => 'C.MAL.MOYEN',
                'libelle' => 'Congé maladie moyenne durée',
                'description' => 'Congé maladie de moyenne durée (max 3 ans)',
                'max_jours' => 1095, // 3 ans * 365 jours
                'categorie' => 'MALADIE',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'code' => 'C.MAL.LONG',
                'libelle' => 'Congé maladie longue durée',
                'description' => 'Congé maladie de longue durée (max 5 ans)',
                'max_jours' => 1825, // 5 ans * 365 jours
                'categorie' => 'MALADIE',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Congés de paternité
            [
                'code' => 'C.PATERNITE',
                'libelle' => 'Congé de paternité',
                'description' => 'Congé accordé au père à la naissance de l\'enfant',
                'max_jours' => 15,
                'categorie' => 'PARENTAL',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'code' => 'C.KAFALA.PAT',
                'libelle' => 'Congé kafala - Paternité',
                'description' => 'Congé pour kafala (père)',
                'max_jours' => 15,
                'categorie' => 'PARENTAL',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Congés de maternité
            [
                'code' => 'C.MATERNITE',
                'libelle' => 'Congé de maternité',
                'description' => 'Congé accordé à la mère pour la naissance',
                'max_jours' => 98,
                'categorie' => 'PARENTAL',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'code' => 'C.KAFALA.MAT',
                'libelle' => 'Congé kafala - Maternité',
                'description' => 'Congé pour kafala (mère) - enfant de moins de 2 ans',
                'max_jours' => 98,
                'categorie' => 'PARENTAL',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'code' => 'C.ALLAITEMENT',
                'libelle' => 'Repos d\'allaitement',
                'description' => 'Repos d\'allaitement jusqu\'aux 24 mois de l\'enfant',
                'max_jours' => 730, // 2 ans * 365 jours
                'categorie' => 'PARENTAL',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Congé sans solde
            [
                'code' => 'C.SANS.SOLDE',
                'libelle' => 'Congé sans solde',
                'description' => 'Congé sans solde (1 mois par année)',
                'max_jours' => 30,
                'categorie' => 'SANS_SOLDE',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
