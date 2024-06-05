<?php

namespace Database\Seeders;

use App\Models\CarBrand;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CarBrandSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    (new CarBrand())->insert([
      [
        'name' => 'BMW',
        'slug' => 'mnw',

        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'name' => 'Mercedes',
        'slug' => 'mercedes',

        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'name' => 'Lexis',
        'slug' => 'lexis',

        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'name' => 'Audi',
        'slug' => 'audi',

        'created_at' => now(),
        'updated_at' => now(),
      ],
    ]);
  }
}
