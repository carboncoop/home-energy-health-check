<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAssessmentMiscComments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
     public function up()
     {
         Schema::table('assessments', function (Blueprint $table) {
             $table->longText('misc_comments')->nullable();
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
             if (Schema::hasColumn('assessments', 'misc_comments')) {
                 $table->dropColumn(['misc_comments']);
             }
         });
     }
}
