<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAssessmentPriorityWork extends Migration
{

    protected function fields() {
        return [
            'priority_work_gutters_yn' => 'boolean',
            'priority_work_exterior_hazards_yn' => 'boolean',
            'priority_work_re_pointing_yn' => 'boolean',
            'priority_work_fencing_yn' => 'boolean',
            'priority_work_gate_bolts_yn' => 'boolean',
            'priority_work_door_locks_yn' => 'boolean',
            'priority_work_spy_hole_yn' => 'boolean',
            'priority_work_door_chain_yn' => 'boolean',
            'priority_work_door_bars_yn' => 'boolean',
            'priority_work_door_bell_yn' => 'boolean',
            'priority_work_security_lights_yn' => 'boolean',
            'priority_work_curtain_poles_yn' => 'boolean',
            'priority_work_interior_hazards_yn' => 'boolean',
            'priority_work_carpet_trims_yn' => 'boolean',
            'priority_work_cm_alarm_yn' => 'boolean',
            'priority_work_bannister_rails_yn' => 'boolean',
            'priority_work_interior_lights_yn' => 'boolean',
            'priority_work_re_seal_yn' => 'boolean',
            'priority_work_toilet_seat_yn' => 'boolean',
            'priority_work_quote_tap_repairs_yn' => 'boolean',
            'priority_work_quote_plumbing_leaks_yn' => 'boolean',
            'priority_work_quote_toilet_repairs_yn' => 'boolean',
            'priority_work_quote_other_yn' => 'boolean',

            'priority_work_gutters_comment' => 'longText',
            'priority_work_exterior_hazards_comment' => 'longText',
            'priority_work_re_pointing_comment' => 'longText',
            'priority_work_fencing_comment' => 'longText',
            'priority_work_gate_bolts_comment' => 'longText',
            'priority_work_door_locks_comment' => 'longText',
            'priority_work_spy_hole_comment' => 'longText',
            'priority_work_door_chain_comment' => 'longText',
            'priority_work_door_bars_comment' => 'longText',
            'priority_work_door_bell_comment' => 'longText',
            'priority_work_security_lights_comment' => 'longText',
            'priority_work_curtain_poles_comment' => 'longText',
            'priority_work_interior_hazards_comment' => 'longText',
            'priority_work_carpet_trims_comment' => 'longText',
            'priority_work_cm_alarm_comment' => 'longText',
            'priority_work_bannister_rails_comment' => 'longText',
            'priority_work_interior_lights_comment' => 'longText',
            'priority_work_re_seal_comment' => 'longText',
            'priority_work_toilet_seat_comment' => 'longText',
            'priority_work_quote_tap_repairs_comment' => 'longText',
            'priority_work_quote_plumbing_leaks_comment' => 'longText',
            'priority_work_quote_toilet_repairs_comment' => 'longText',
            'priority_work_quote_other_comment' => 'longText',
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
                 if ('longText' == $type) {
                     $table->longText($name)->nullable();
                 } else if ('boolean' == $type) {
                     $table->boolean($name)->nullable();
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
                if (Schema::hasColumn('assessments', $name)) {
                    $table->dropColumn([$name]);
                }
            }
        });
    }
}
