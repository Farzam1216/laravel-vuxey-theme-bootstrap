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

      // multipe leads assgin
      // [
      //   'name' => 'sites.crm.opportunity.ajax-assign-multiple-leads',
      //   'show_name' => 'Can Assign Multiple Leads',
      //   'guard_name' => 'web',
      //   'title' => 'CRM',
      // ],


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
        // 'is_new' => $permission['is_new'] ?? false,
        'show_name' => $permission['show_name'],
        'title' => $permission['title'] ?? null,
      ]);
    }

    (new Role())->find(1)->givePermissionTo((new Permission())->where('is_custom', false)->pluck('id'));
    $childRoles = Role::where('parent_id', 1)->where('is_child', true)->get();
    $parentRole = (new Role())->find(1);

    foreach ($childRoles as $childRole) {
      $childRole->givePermissionTo($parentRole->permissions);
    }
  }
}
