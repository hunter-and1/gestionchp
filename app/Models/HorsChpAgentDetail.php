<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HorsChpAgentDetail extends Model
{
    use HasFactory;

    protected $fillable = ['agent_id', 'contract_type'];

    // Relationship with Agent
    public function agent()
    {
        return $this->belongsTo(Agent::class);
    }
}
