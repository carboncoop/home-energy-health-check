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
            'checklist' => self::homeVisitChecklist(),
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
                    'helpText' => ['Too hot', 'Just right', 'Too cold']
                ],
                'comfort_rate_temperature_winter' => [
                    'label' => 'Temperature in the Winter',
                    'helpText' => ['Too hot', 'Just right', 'Too cold']
                ],
                'comfort_rate_humidity_summer' => [
                    'label' => 'Air Quality in the Summer',
                    'helpText' => ['Too dry', 'Just right', 'Too stuffy']
                ],
                'comfort_rate_humidity_winter' => [
                    'label' => 'Air Quality in the Winter',
                    'helpText' => ['Too dry', 'Just right',  'Too stuffy']
                ],
                'comfort_rate_airflow_summer' => [
                    'label' => 'Air Movement in the Summer',
                    'helpText' => ['Too draughty', 'Just right',  'Too still']
                ],
                'comfort_rate_airflow_winter' => [
                    'label' => 'Air Movement in the Winter',
                    'helpText' => ['Too draughty', 'Just right',  'Too still']
                ],
                /*'comfort_rate_natural_light' => [
                    'label' => 'Natural light',
                    'helpText' => ['Too little', 'Just right',  'Too much']
                ],*/
                'comfort_rate_artificial_light' => [
                    'label' => 'Artificial light',
                    'helpText' => ['Too little', 'Just right',  'Too much']
                ],
                /*'comfort_rate_noise_levels' => [
                    'label' => 'Noise levels',
                    'helpText' => ['Too noisy', 'Just right',  'Too quiet']
                ]*/
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
                //'reading_surface_temperature_living_room' => 'Average surface temperature (living room)',
                'reading_temperature_bedroom' => 'Temperature spot check (bedroom)',
                'reading_humidity_bedroom' => 'Relative humidity spot check (bedroom)',
                //'reading_surface_temperature_bedroom' => 'Average surface temperature (bedroom)',
                //'reading_air_quality' => 'Air Quality Reading'
            ],
            'textareaElements' => [
                'Temperature & Air Quality Readings' => [
                    'health_surface_temperature_notes' => 'Assessor note - any noticeable cold spots or draughts? - any noticeable stuffiness?'
                ],
                'Home Health Comment' => [
                    'health_condensation' => 'Condensation',
                    'health_damp' => 'Damp',
                    'health_mold' => 'Mold',
                    'health_ventilation' => 'Ventilation',
                    'health_laundry' => 'Laundry',
                    //'health_air_quality' => 'Air Quality'
                ],
            ],
        ];
    }

    public static function prependHealthFieldsYesNo()
    {
        return [
            'Personal Health Check' => [
                'health_yn_well' => 'Are you generally well?',
                'health_yn_meds_sufficient' => 'Do you keep sufficient medication?',
                'health_yn_meds_deliver' => 'Does the pharmacy deliver you medication for you?',
                'health_yn_access_gp' => 'Are you able to access your GP?',
                'health_yn_food_34days' => 'Would you have enough food to last 3 to 4 days without having to go out?',
                'health_yn_food_help' => 'If NO would you have anyone who could get food for you?',
                'health_yn_severe_weather' => 'In the event of severe weather and or heavy snow fall for a prolonged period would you like a call to see how you are coping?',
                'health_yn_flu_jab' => 'Have you had a flu jab?',
                // @TODO: Ask If not ask why not (encourage people to have one)
            ],
            'Fall Risk Assessment' => [
                'health_yn_fall_history' => 'History of any fall in the last year?',
                'health_yn_fall_4plus_meds' => 'Four or more medications per day?',
                'health_yn_fall_stroke_parkinsons' => 'Diagnosis of stroke or Parkinson\'s Disease?',
                'health_yn_fall_balance' => 'Any problems with his/her balance?',
                'health_yn_fall_permission_refer' => 'If YES ask permission to refer to Falls Team.',
            ],
        ];
    }

    public static function homeVisitChecklist()
    {
        return [
            'checklist_health' => 'Health Conditions? Warm and Well',
            'checklist_warm_discount' => 'Eligible for Warm Home Discount?',
            'checklist_priority' => 'Priority Services Register?',
            'checklist_fuel_debt' => 'Fuel Debt?',
            'checklist_supplier_issues' => 'Issues with supplier?',
            'checklist_water_debt' => 'Water Debt Gateway referral?',
            'checklist_switching' => 'Switching / tariff and bills discussed?',
            'checklist_income_max' => 'Income Maximisation further discussion/assistance needed?',
            'checklist_fire_safety' => 'Fire Safety check – smoke/Co2 monitor?',
            'checklist_further_visit' => 'Further Home Visit by PEC required',
            'checklist_further_assistance' => 'Notes/ any further assistance we can offer?',
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
