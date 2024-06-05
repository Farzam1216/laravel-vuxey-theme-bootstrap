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
    if (!Schema::hasColumn('cars', 'available_for_sale')) {
      Schema::table('cars', function (Blueprint $table) {
        $table->string('available_for_sale')->nullable();
      });
    }

    if (!Schema::hasColumn('users', 'dicount_on_number_of_bookings_per_month')) {
      Schema::table('users', function (Blueprint $table) {
        $table->double('dicount_on_number_of_bookings_per_month')->nullable();
      });
    }

    if (!Schema::hasColumn('users', 'disount_percentage')) {
      Schema::table('users', function (Blueprint $table) {
        $table->double('disount_percentage')->nullable();
      });
    }
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::table('cars', function (Blueprint $table) {
      //
    });
  }
};
