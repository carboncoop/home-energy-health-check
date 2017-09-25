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
        'benefits', 'who_can_do',
        'assessor_guidance', 'assessor_comment',
    ];

    public function section()
    {
        return $this->belongsTo(Section::class);
    }

    public function getAssessorCommentAttribute($value) {
        if ($value != '') {
            return $value;
        }
        return '- add any notes here.';
    }

}
