<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SoldeConge extends Model
{
    protected $fillable = [
        'agent_id',
        'annee',
        'solde_initial',
        'solde_restant',
        'is_initialized'
    ];

    public function agent()
    {
        return $this->belongsTo(Agent::class);
    }
}
