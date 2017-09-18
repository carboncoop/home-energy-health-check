<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Improvement;

class Section extends Model
{

    protected $fillable = [
        'title', 'description'
    ];

    protected function improvements()
    {
        return $this->hasMany(Improvement::class);
    }
}
