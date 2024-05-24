<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


class UsersSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    //
    $user = (new User())->create([
      'name' => 'Admin',
      'email' => 'admin@admin.com',
      'password' => Hash::make('password'),
      'mobile_no' => '03185405672',
      'user_name' => 'admin123',
      'email_verified_at' => now(),
      'created_at' => now(),
      'updated_at' => now(),
      'remember_token' => Str::random(10),
    ]);
    $user->assignRole([1]);

    $user = (new User())->create([
      'name' => 'Customer',
      'email' => 'customer@customer.com',
      'password' => Hash::make('password'),
      'mobile_no' => '03415913031',
      'user_name' => 'customer123',
      'email_verified_at' => now(),
      'created_at' => now(),
      'updated_at' => now(),
      'remember_token' => Str::random(10),
    ]);
    $user->assignRole([2]);
  }
}
