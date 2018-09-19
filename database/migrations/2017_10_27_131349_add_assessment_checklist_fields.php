<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAssessmentChecklistFields extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */

     protected $fields = [
         'checklist_hia_referral' => 'longText',
         'checklist_prepayment_meter' => 'longText',
         'checklist_switch_save' => 'longText',
         'checklist_boiler_check' => 'longText',
         'checklist_fire_service_refer' => 'longText',
         'checklist_deliver_grit' => 'longText',
     ];

     public function up()
     {
         Schema::table('assessments', function (Blueprint $table) {
             foreach ($this->fields as $field => $type) {
                 if ($type == 'longText') {
                     $table->longText($field)->nullable();
                 } else if ($type == 'boolean') {
                     $table->boolean($field)->nullable();
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
             foreach ($this->fields as $field => $type) {
                 if (Schema::hasColumn('assessments', $field)) {
                     $table->dropColumn([$field]);
                 }
             }
         });
     }
}
