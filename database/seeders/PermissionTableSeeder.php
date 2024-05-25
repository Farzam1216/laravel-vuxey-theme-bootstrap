<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    //
    $data = [
      [
        'name' => 'dashboard',
        'show_name' => 'Can View Dashboard',
        'guard_name' => 'web',
        'title' => 'Dashboard',
      ],
      // Roles Routes
      [
        'name' => 'roles.index',
        'guard_name' => 'web',
        'show_name' => 'Can View Roles',
        'title' => 'Roles',

      ],
      [
        'name' => 'roles.create',
        'guard_name' => 'web',
        'show_name' => 'Can Create Role',
        'title' => 'Roles',

      ],
      [
        'name' => 'roles.store',
        'guard_name' => 'web',
        'show_name' => 'Can Store Role',
        'title' => 'Roles',

      ],
      [
        'name' => 'roles.edit',
        'guard_name' => 'web',
        'show_name' => 'Can Edit Role',
        'title' => 'Roles',

      ],
      [
        'name' => 'roles.update',
        'guard_name' => 'web',
        'show_name' => 'Can Update Role',
        'title' => 'Roles',

      ],
      [
        'name' => 'roles.destroy',
        'show_name' => 'Can Delete Role',
        'guard_name' => 'web',
        'title' => 'Roles',

      ],
      [
        'name' => 'roles.destroy-selected',
        'guard_name' => 'web',
        'show_name' => 'Can Delete Selected Roles',
        'title' => 'Roles',

      ],
      [
        'name' => 'roles.make-default',
        'guard_name' => 'web',
        'show_name' => 'Can Make Default Roles',
        'title' => 'Roles',

      ],

      // Permissions Routes
      [
        'name' => 'permissions.index',
        'guard_name' => 'web',
        'show_name' => 'Can View Permissions',
        'title' => 'Permissions',

      ],
      [
        'name' => 'permissions.view_all',
        'guard_name' => 'web',
        'show_name' => 'Can View All Site Roles Permissions',
        'title' => 'Permissions',

      ],
      [
        'name' => 'permissions.assign-permission',
        'show_name' => 'Can Assign Permission',
        'guard_name' => 'web',
        'title' => 'Permissions',

      ],
      [
        'name' => 'permissions.revoke-permission',
        'show_name' => 'Can Revoke Permission',
        'guard_name' => 'web',
        'title' => 'Permissions',

      ],
      [
        'name' => 'permissions.edit-own-permission',
        'show_name' => 'Can Edit Own Permission',
        'guard_name' => 'web',
        'title' => 'Permissions',

      ],
      // Users
      [
        'name' => 'users.index',
        'show_name' => 'Can View Users',
        'guard_name' => 'web',
        'title' => 'Users',
      ],
      [
        'name' => 'users.create',
        'show_name' => 'Can Create Users',
        'guard_name' => 'web',
        'title' => 'Users',
      ],
      [
        'name' => 'users.store',
        'show_name' => 'Can Store Users',
        'guard_name' => 'web',
        'title' => 'Users',
      ],
      [
        'name' => 'users.edit',
        'show_name' => 'Can Edit Users',
        'guard_name' => 'web',
        'title' => 'Users',
      ],
      [
        'name' => 'users.update',
        'show_name' => 'Can Update Users',
        'guard_name' => 'web',
        'title' => 'Users',
      ],
      // [
      //   'name' => 'users.destroy-selected',
      //   'show_name' => 'Can Suspend Selected Users',
      //   'guard_name' => 'web',
      //   'title' => 'Users',
      // ],

      // car categories
      [
        'name' => 'car-categories.index',
        'show_name' => 'Can View Car Categories',
        'guard_name' => 'web',
        'title' => 'Car Categories',
      ],
      [
        'name' => 'car-categories.create',
        'show_name' => 'Can Create Car Categories',
        'guard_name' => 'web',
        'title' => 'Car Categories',
      ],
      [
        'name' => 'car-categories.store',
        'show_name' => 'Can Store Car Categories',
        'guard_name' => 'web',
        'title' => 'Car Categories',
      ],
      [
        'name' => 'car-categories.edit',
        'show_name' => 'Can Edit Car Categories',
        'guard_name' => 'web',
        'title' => 'Car Categories',
      ],
      [
        'name' => 'car-categories.update',
        'show_name' => 'Can Update Car Categories',
        'guard_name' => 'web',
        'title' => 'Car Categories',
      ],

      // cars
      [
        'name' => 'cars.index',
        'show_name' => 'Can View Car Details',
        'guard_name' => 'web',
        'title' => 'Car Details',
      ],
      [
        'name' => 'cars.create',
        'show_name' => 'Can Create Car Details',
        'guard_name' => 'web',
        'title' => 'Car Details',
      ],
      [
        'name' => 'cars.store',
        'show_name' => 'Can Store Car Details',
        'guard_name' => 'web',
        'title' => 'Car Details',
      ],
      [
        'name' => 'cars.edit',
        'show_name' => 'Can Edit Car Details',
        'guard_name' => 'web',
        'title' => 'Car Details',
      ],
      [
        'name' => 'cars.update',
        'show_name' => 'Can Update Car Details',
        'guard_name' => 'web',
        'title' => 'Car Details',
      ],



    ];

    foreach ($data as $permission) {
      $permision_exist = Permission::where('name', $permission['name'])->first();

      // if ($permision_exist) {
      //   if (isset($permission['is_new'])) {
      //     $permision_exist->is_new = $permission['is_new'] ?? false;
      //     $permision_exist->save();
      //   }
      // }
      Permission::updateOrCreate([
        'name' => $permission['name'],
        'guard_name' => 'web',
      ], [
        'show_name' => $permission['show_name'],
        'title' => $permission['title'] ?? null,
      ]);
    }

    (new Role())->find(1)->givePermissionTo((new Permission())->pluck('id'));
    // $childRoles = Role::where('parent_id', 1)->where('is_child', true)->get();
    // $parentRole = (new Role())->find(1);

    // foreach ($childRoles as $childRole) {
    //   $childRole->givePermissionTo($parentRole->permissions);
    // }
  }
}
