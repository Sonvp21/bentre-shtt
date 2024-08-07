<?php

namespace App\Policies;

use App\Models\User;

class IndustrialDesignTypePolicy
{
//tên biến trùng vs database
    public function index(User $user): bool
    {
        return $user->checkPermissionAccess('industrial_design_types_index');
    }

    public function create(User $user): bool
    {
        return $user->checkPermissionAccess('industrial_design_types_create');
    }

    public function edit(User $user): bool
    {
        return $user->checkPermissionAccess('industrial_design_types_edit');
    }

    public function destroy(User $user): bool
    {
        return $user->checkPermissionAccess('industrial_design_types_destroy');
    }

}
