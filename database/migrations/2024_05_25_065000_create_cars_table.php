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
    Schema::create('cars', function (Blueprint $table) {
      $table->id();
      $table->unsignedBigInteger('category_id')->nullable();
      $table->unsignedBigInteger('owner_id')->nullable();
      $table->unsignedBigInteger('brand_id')->nullable();
      $table->string('name')->nullable();
      $table->string('brand_name')->nullable();
      $table->string('reg_no')->nullable();
      $table->string('color')->nullable();
      $table->string('model')->nullable();
      $table->string('owner_name')->nullable();
      $table->string('owner_contact_no')->nullable();
      $table->string('owner_email')->nullable();
      $table->longText('description')->nullable();
      $table->double('full_day_rate_with_fuel')->nullable();
      $table->double('full_day_rate_without_fuel')->nullable();
      $table->double('full_day_rate_with_driver')->nullable();
      $table->double('full_day_rate_without_driver')->nullable();
      $table->double('per_km_rate_with_fuel')->nullable();
      $table->double('per_km_rate_without_fuel')->nullable();
      $table->double('sale_price')->nullable();
      $table->double('discounted_sale_price')->nullable();
      $table->string('longitude')->nullable();
      $table->string('latitude')->nullable();
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
    Schema::dropIfExists('cars');
  }
};
