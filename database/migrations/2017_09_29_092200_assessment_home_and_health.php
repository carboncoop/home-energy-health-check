<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AssessmentHomeAndHealth extends Migration
{

    protected function fields() {
        return [
            // Home comfort check

            // What of the following is most important to you:
            'comfort_rate_comfort' => 'tiny',
            'comfort_rate_health' => 'tiny',
            'comfort_rate_environment' => 'tiny',
            'comfort_rate_saving_money' => 'tiny',

            // How do you find your home?
            'comfort_rate_temperature_summer' => 'tiny',
            'comfort_rate_temperature_winter' => 'tiny',
            'comfort_rate_humidity_summer' => 'tiny',
            'comfort_rate_humidity_winter' => 'tiny',
            'comfort_rate_airflow_summer' => 'tiny',
            'comfort_rate_airflow_winter' => 'tiny',
            'comfort_rate_natural_light' => 'tiny',
            'comfort_rate_artificial_light' => 'tiny',
            'comfort_rate_noise_levels' => 'tiny',

            // other homeowner comments
            'comfort_general' => 'longText',
            'comfort_favourite_room' => 'text',
            'comfort_least_loved_room' => 'text',
            'comfort_other_comments' => 'longText',
        ];
    }
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('assessments', function (Blueprint $table) {
            foreach ($this->fields() as $name => $type) {
                if ('tiny' == $type) {
                    $table->tinyInteger($name)->nullable();
                } else if ('longText' == $type) {
                    $table->longText($name)->nullable();
                } else {
                    $table->string($name)->nullable();
                }
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('assessments', function (Blueprint $table) {
            foreach ($this->fields() as $name => $type) {
                $table->dropColumn([$name]);
            }
        });
    }
}
