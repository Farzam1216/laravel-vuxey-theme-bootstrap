<?php

namespace App\Services\Roles;

use Spatie\Permission\Models\Role as ModelsRole;

class RoleService implements RoleInterface
{
    public function model()
    {
        return new ModelsRole();
    }

    public function getAllWithTree()
    {
        $roles = $this->model()->where('is_child', false)->get();

        return getTreeData(collect($roles), $this->model());
    }
}
