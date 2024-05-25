<?php

namespace Database\Seeders;

use App\Models\Car;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CarSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    //
    (new Car())->insert([
      [

        'category_id' => 1,
        // 'owner_id',
        // 'brand_id',
        'name' => 'MG HS',
        'brand_name' => 'MG',
        'reg_no' => 'ADX-2910',
        'color' => 'Black',
        'model' => '2021',
        'owner_name' => 'Farzam Ali',
        'owner_contact_no' => '03185405672',
        // 'description',
        'full_day_rate_with_fuel' => 2000,
        'full_day_rate_without_fuel' => 1000,
        'full_day_rate_with_driver' => 2000,
        'full_day_rate_without_driver'=> 1500,
        'per_km_rate_with_fuel' => 200,
        'per_km_rate_without_fuel' => 100,
        'longitude' => 32.8594,
        'latitude' => 72.9431,
        'sale_price' => 10000000,
        'discounted_sale_price' =>  9000000,
        'created_at' => now(),
        'updated_at' => now(),
      ],
    ]);
  }
}
