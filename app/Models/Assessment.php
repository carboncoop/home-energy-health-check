<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Backpack\CRUD\CrudTrait;

class Assessment extends Model
{
    use CrudTrait;

    protected $fillable = [
        'title', 'email_address'
    ];

}
