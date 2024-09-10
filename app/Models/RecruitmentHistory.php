<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RecruitmentHistory extends Model
{
    use HasFactory;

    protected $fillable = ['agent_id', 'event', 'old_value', 'new_value'];

    // Relationship with Agent
    public function agent()
    {
        return $this->belongsTo(Agent::class);
    }
}
