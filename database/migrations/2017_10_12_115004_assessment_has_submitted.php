<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AssessmentHasSubmitted extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('assessments', function (Blueprint $table) {
            $table->boolean('submitted')->default(false);
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
            if (Schema::hasColumn('assessments', 'submitted')) {
                $table->dropColumn(['submitted']);
            }
        });
    }
}
