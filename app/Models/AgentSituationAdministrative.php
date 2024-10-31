<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AgentSituationAdministrative extends Model
{
    use HasFactory;

    protected $fillable = [
        'agent_id', 'corps', 'cadre', 'grade', 'echelon', 'specialite', 'note', 'note', 'date', 'obs','modifications'
    ];

    protected $casts = [
        'modifications' => 'array',
    ];

    public function agent()
    {
        return $this->belongsTo(Agent::class);
    }
}
