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
         'checklist_health' => 'longText',
         'checklist_warm_discount' => 'longText',
         'checklist_priority' => 'longText',
         'checklist_fuel_debt' => 'longText',
         'checklist_supplier_issues' => 'longText',
         'checklist_water_debt' => 'longText',
         'checklist_switching' => 'longText',
         'checklist_income_max' => 'longText',
         'checklist_fire_safety' => 'longText',
         'checklist_further_visit' => 'boolean',
         'checklist_further_assistance' => 'longText',
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
