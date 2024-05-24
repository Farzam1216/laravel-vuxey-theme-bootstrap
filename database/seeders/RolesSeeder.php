<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RolesSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    //
    (new Role())->insert([
      [
        'name' => 'Admin',
        'guard_name' => 'web',
        'parent_id' => 0,
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'name' => 'Customer',
        'guard_name' => 'web',
        'parent_id' => 1,
        'created_at' => now(),
        'updated_at' => now(),
      ],
    ]);
  }
}
