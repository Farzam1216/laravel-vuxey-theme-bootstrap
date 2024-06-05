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
    Schema::dropIfExists('car_bookings');

    Schema::create('car_bookings', function (Blueprint $table) {
      $table->id();
      $table->unsignedBigInteger('user_id');
      $table->unsignedBigInteger('car_id');
      $table->string('rent_type');
      $table->integer('total_km')->nullable();
      $table->date('pick_up_date');
      $table->date('drop_off_date');
      $table->string('pickup_location');
      $table->string('dropoff_location');
      $table->time('pickup_time')->nullable();
      $table->decimal('car_rate', 8, 2);
      $table->decimal('total_fare', 8, 2);
      $table->timestamps();

      $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
      $table->foreign('car_id')->references('id')->on('cars')->onDelete('cascade');
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
