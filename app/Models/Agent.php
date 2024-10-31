<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agent extends Model
{
    use HasFactory;


    protected $fillable = [
        'category',
        'sub_category',
        'affectation',
        'statut',
        'position',
        'motif_entree',
        'type_mouvement',
        'reference',
        'date_reference',
        'observation',
        'nom_fr',
        'prenom_fr',
        'prenom_ar',
        'nom_ar',
        'cin',
        'ppr',
        'date_naissance',
        'lieu_naissance_fr',
        'lieu_naissance_ar',
        'date_recrutement',
    ];

}
