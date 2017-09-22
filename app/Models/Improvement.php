<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Section;
use Backpack\CRUD\CrudTrait;

class Improvement extends Model
{
    use CrudTrait;

    protected $fillable = [
        'title', 'section_id',
        'description', 'estimated_cost',
        'benefits', 'who_can_do', 'assessor_guidance'
    ];

    public function section()
    {
        return $this->belongsTo(Section::class);
    }

}
