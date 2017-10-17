<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Improvement;
use Backpack\CRUD\CrudTrait;

class Part extends Model
{
    use CrudTrait;

    protected $fillable = [
        'title', 'description'
    ];

    public function improvements()
    {
        return $this->hasMany(Improvement::class);
    }

    public static function crudFields()
    {
        return [
            'title' => [
                'label' => 'Title',
                'type' => 'text',
                'index' => true,
            ],
            'description' => [
                'label' => 'Description',
                'type' => 'simplemde',
            ],
        ];
    }
}
