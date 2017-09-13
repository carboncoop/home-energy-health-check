<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddImprovementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('improvements', function (Blueprint $table) {
          $table->increments('id');
          $table->string('title');
          $table->longText('description');
          $table->text('estimated_cost');
          $table->text('benefits');
          $table->text('who_can_do');
          $table->text('assessor_guidance');
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
        Schema::drop('improvements');
    }
}
