<?php

namespace Database\Seeders;

use App\Models\CarCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CarCategorySeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    //
    (new CarCategory())->insert([
      [
        'name' => 'SUV',
        'slug' => 'suv',
        'status' => 1,
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'name' => 'Sedan',
        'slug' => 'sedan',
        'status' => 1,
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'name' => 'Hatchback',
        'slug' => 'hatchback',
        'status' => 1,
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'name' => 'Jeeps',
        'slug' => 'jeeps',
        'status' => 1,
        'created_at' => now(),
        'updated_at' => now(),
      ],
    ]);
  }
}
