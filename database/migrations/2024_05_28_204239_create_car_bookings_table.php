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
      $table->string('pick_up_location')->nullable();
      $table->string('drop_off_location')->nullable();
      $table->string('pick_up_date')->nullable();
      $table->string('drop_off_date')->nullable();
      $table->double('rate')->nullable();
      $table->double('discount_rate')->nullable();
      $table->string('status')->nullable();
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
