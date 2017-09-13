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
  public function up() {
    Schema::create('improvements', function (Blueprint $table) {
      $table->increments('id');
      $table->string('title');
      $table->longText('description')->nullable();
      $table->string('estimated_cost')->nullable();
      $table->string('benefits')->nullable();
      $table->string('who_can_do')->nullable();
      $table->longText('assessor_guidance')->nullable();
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down() {
    Schema::drop('improvements');
  }
}
