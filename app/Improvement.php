<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Improvement extends Model
{
    protected $fillable = [
    'title', 'description', 'estimated_cost', 'benefits', 'who_can_do', 'assessor_guidance'
  ];
}
