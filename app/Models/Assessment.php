<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Backpack\CRUD\CrudTrait;

class Assessment extends Model
{
    use CrudTrait;

    protected $fillable = [
        'assessor_name', 'assessment_date',
        'homeowner_name', 'homeowner_email',
        'homeowner_phone', 'homeowner_address',
        'home_type',
    ];

}
