<?php

namespace App\Policies;

use App\Models\User;

class IndustrialDesignPolicy
{
//tên biến trùng vs database
    public function index(User $user): bool
    {
        return $user->checkPermissionAccess('industrial_design_index');
    }

    public function create(User $user): bool
    {
        return $user->checkPermissionAccess('industrial_design_create');
    }

    public function edit(User $user): bool
    {
        return $user->checkPermissionAccess('industrial_design_edit');
    }

    public function destroy(User $user): bool
    {
        return $user->checkPermissionAccess('industrial_design_destroy');
    }

}
