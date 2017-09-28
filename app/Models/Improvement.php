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

    public static function crudFields()
    {
        return [
            'title' => [
                'label' => 'Title',
                'type' => 'text',
                'index' => true,
            ],
            'section_id' => [
                'label' => "Section",
                'type' => 'select',
                'entity' => 'section',
                'attribute' => 'title',
                'model' => "App\Models\Section",
                'index' => true,
            ],
            'description' => [
                'label' => 'Description',
                'type' => 'textarea',
            ],
            'estimated_cost' => [
                'label' => 'Estimated Cost',
                'type' => 'text',
                'index' => true,
            ],
            'benefits' => [
                'label' => 'Benefits / Savings',
                'type' => 'text',
            ],
            'who_can_do' => [
                'label' => 'Who can do this work?',
                'type' => 'text',
            ],
            'assessor_guidance' => [
                'label' => 'Guidance to Assessor',
                'type' => 'textarea',
            ],
            'assessor_comment' => [
                'label' => 'Assessor Comment',
                'type' => 'textarea',
            ]
        ];
    }

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
