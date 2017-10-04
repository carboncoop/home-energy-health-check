<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\AssessmentImprovement;
use Backpack\CRUD\CrudTrait;

class Assessment extends Model
{
    use CrudTrait;

    protected $guarded = [];

    public function assessment_improvements()
    {
        return $this->hasMany(AssessmentImprovement::class);
    }

    public static function crudFields()
    {
        return [
            'assessor_name' => [
                'label' => 'Assessor Name',
                'type' => 'text',
            ],
            'assessment_date' => [
                'label' => 'Assessment Date',
                'type' => 'text',
                'index' => true,
            ],
            'homeowner_name' => [
                'label' => 'Homeowner Name',
                'type' => 'text',
                'index' => true,
            ],
            'homeowner_email' => [
                'label' => 'Homeowner Email',
                'type' => 'email',
            ],
            'homeowner_phone' => [
                'label' => 'Homeowner Phone',
                'type' => 'text',
            ],
            'homeowner_address' => [
                'label' => 'Homeowner Address',
                'type' => 'textarea',
                'index' => true,
            ],
            'home_type' => [
                'label' => 'Home Type',
                'type' => 'text',
            ],
        ];
    }

}
