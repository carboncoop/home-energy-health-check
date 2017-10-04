<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Assessment;

class AssessmentImprovement extends Model
{
    protected $guarded = [];

    public function assessment()
    {
        return $this->belongsTo(Assessment::class);
    }

}
