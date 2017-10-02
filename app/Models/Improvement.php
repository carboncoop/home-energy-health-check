<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Part;
use Backpack\CRUD\CrudTrait;

class Improvement extends Model
{
    use CrudTrait;

    protected $fillable = [
        'title', 'part_id',
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
            'part_id' => [
                'label' => "Part",
                'type' => 'select',
                'entity' => 'part',
                'attribute' => 'title',
                'model' => "App\Models\Part",
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

    public function part()
    {
        return $this->belongsTo(Part::class);
    }

    public function getAssessorCommentAttribute($value) {
        if ($value != '') {
            return $value;
        }
        return '- add any notes here.';
    }

}
