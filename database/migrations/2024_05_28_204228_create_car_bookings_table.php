<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('car_bookings', function (Blueprint $table) {
      $table->id();
      $table->unsignedBigInteger('car_id')->nullable();
      $table->unsignedBigInteger('user_id')->nullable();
      $table->double('rate')->nullable();
      $table->timestamp('date')->nullable();
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
    Schema::dropIfExists('car_bookings');
  }
};
