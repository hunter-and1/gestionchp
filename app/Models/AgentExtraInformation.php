<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AgentExtraInformation extends Model
{
    use HasFactory;

    protected $fillable = [
        'agent_id', 'adresse_fr', 'adresse_ar','email','telephone','situation_familiale','nombre_enfants' , 'modifications'
    ];

    protected $casts = [
        'modifications' => 'array',
    ];

    public function agent()
    {
        return $this->belongsTo(Agent::class);
    }
}
