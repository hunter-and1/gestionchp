<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChpAgentDetail extends Model
{
    use HasFactory;

    protected $fillable = ['agent_id', 'recruitment_type', 'affectation', 'status', 'position'];

    // Relationship with Agent
    public function agent()
    {
        return $this->belongsTo(Agent::class);
    }
}
