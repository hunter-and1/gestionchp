<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agent extends Model
{
    use HasFactory;

    protected $fillable = ['a_firstname', 'a_lastname', 'a_category'];

    // Relationship with CHP Agent Details
    public function chpAgentDetail()
    {
        return $this->hasOne(ChpAgentDetail::class);
    }

    // Relationship with HORS-CHP Agent Details
    public function horsChpAgentDetail()
    {
        return $this->hasOne(HorsChpAgentDetail::class);
    }

    // Relationship with Recruitment History
    public function recruitmentHistory()
    {
        return $this->hasMany(RecruitmentHistory::class);
    }
}
