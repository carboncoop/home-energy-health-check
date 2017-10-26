<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\AssessmentImprovement;
use Backpack\CRUD\CrudTrait;
use Carbon\Carbon;

class Assessment extends Model
{
    use CrudTrait;

    protected $guarded = [];

    public function assessment_improvements()
    {
        return $this->hasMany(AssessmentImprovement::class);
    }

    public static function boot()
    {
        parent::boot();
        Assessment::deleting(function($ass) {
            foreach ($ass->assessment_improvements as $ai) {
                $ai->delete();
            }
        });
    }

    public function getStatusAttribute()
    {
        if ($this->submitted) {
            return "Submitted";
        } else {
            $now = Carbon::now()->toDateString();
            try {
                $then = Carbon::createFromFormat('Y-m-d', $this->assessment_date);
                $diff = Carbon::now()->diffInDays($then);
                if ($now == $this->assessment_date) {
                    return "Due today.";
                } else if ($now < $this->assessment_date) {
                    return "Due in $diff days.";
                }
            }
            catch (\Exception $err) {
                return "Invalid date format.";
            }
        }
        return "Overdue!";
    }

    public static function formSchema()
    {
        return [
            'comfort' => self::comfortFields(),
            'health' => self::healthFields(),
        ];
    }

    public static function comfortFields()
    {
        return [
            'rateOneToFour' => [
                'comfort_rate_comfort' => 'Comfort',
                'comfort_rate_health' => 'Health',
                'comfort_rate_environment' => 'Environment',
                'comfort_rate_saving_money' => 'Saving Money'
            ],
            'threeWayToggles' => [
                'comfort_rate_temperature_summer' => [
                    'label' => 'Temperature in the Summer',
                    'helpText' => ['Too hot', 'Too cold']
                ],
                'comfort_rate_temperature_winter' => [
                    'label' => 'Temperature in the Winter',
                    'helpText' => ['Too hot', 'Too cold']
                ],
                'comfort_rate_humidity_summer' => [
                    'label' => 'Air in the Summer',
                    'helpText' => ['Too dry', 'Too stuffy']
                ],
                'comfort_rate_humidity_winter' => [
                    'label' => 'Air in the Winter',
                    'helpText' => ['Too dry', 'Too stuffy']
                ],
                'comfort_rate_airflow_summer' => [
                    'label' => 'Air in the Summer',
                    'helpText' => ['Too draughty', 'Just right']
                ],
                'comfort_rate_airflow_winter' => [
                    'label' => 'Air in the Winter',
                    'helpText' => ['Too draughty', 'Just right']
                ],
                'comfort_rate_natural_light' => [
                    'label' => 'Natural light',
                    'helpText' => ['Too little', 'Too much']
                ],
                'comfort_rate_artificial_light' => [
                    'label' => 'Artificial light',
                    'helpText' => ['Too little', 'Too much']
                ],
                'comfort_rate_noise_levels' => [
                    'label' => 'Noise levels',
                    'helpText' => ['Too noisy', 'Too quiet']
                ]
            ],
            'otherInfo' => [
                'comfort_general' => 'General comfort',
                'comfort_favourite_room' => 'What is your favourite room?',
                'comfort_least_loved_room' => 'What is your least loved room?',
                'comfort_other_comments' => 'Any other comments'
            ],
        ];
    }

    public static function healthFields()
    {
        return [
            'readingElements' => [
                'reading_temperature_living_room' => 'Temperature spot check (living room)',
                'reading_humidity_living_room' => 'Relative humidity spot check (living room)',
                'reading_surface_temperature_living_room' => 'Average surface temperature (living room)',
                'reading_temperature_bedroom' => 'Temperature spot check (bedroom)',
                'reading_humidity_bedroom' => 'Relative humidity spot check (bedroom)',
                'reading_surface_temperature_bedroom' => 'Average surface temperature (bedroom)',
                'reading_air_quality' => 'Air Quality Reading'
            ],
            'textareaElements' => [
                'Temperature Readings' => [
                    'health_surface_temperature_notes' => 'Assessor note on surface temperature. Any cold spots?'
                ],
                'Home Health Comment' => [
                    'health_condensation' => 'Condensation',
                    'health_damp' => 'Damp',
                    'health_mold' => 'Mold',
                    'health_ventilation' => 'Ventilation',
                    'health_laundry' => 'Laundry',
                    'health_air_quality' => 'Air Quality'
                ],
            ],
        ];
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
                'type' => 'date',
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
