<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAssessmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assessments', function (Blueprint $table) {
            $table->increments('id');
            $table->string('assessor_name')->nullable();
            $table->string('assessment_date')->nullable();
            $table->string('homeowner_name')->nullable();
            $table->string('homeowner_email')->nullable();
            $table->string('homeowner_phone')->nullable();
            $table->longText('homeowner_address')->nullable();
            $table->string('home_type')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('assessments');
    }
}
