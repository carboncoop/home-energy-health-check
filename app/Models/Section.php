<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Backpack\CRUD\CrudTrait;

class Section extends Model
{
    use CrudTrait;

    public $fillable = [
        'title', 'body'
    ];

    public static function crudFields()
    {
        return [
            'title' => [
                'label' => 'Title',
                'type' => 'text',
                'index' => true,
            ],
            'body' => [
                'label' => 'Body Text',
                'type' => 'simplemde'
            ],
        ];
    }

}
