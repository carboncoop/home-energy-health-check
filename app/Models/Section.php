<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Improvement;
use Backpack\CRUD\CrudTrait;

class Section extends Model
{
    use CrudTrait;

    protected $fillable = [
        'title', 'description'
    ];

    protected function improvements()
    {
        return $this->hasMany(Improvement::class);
    }
}
