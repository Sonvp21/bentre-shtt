<?php

namespace App\Policies;

use App\Models\User;

class RolePolicy
{
//tên biến trùng vs database
    public function index(User $user): bool
    {
        return $user->checkPermissionAccess('role_index');
    }

    public function create(User $user): bool
    {
        return $user->checkPermissionAccess('role_create');
    }

    public function edit(User $user): bool
    {
        return $user->checkPermissionAccess('role_edit');
    }

    public function destroy(User $user): bool
    {
        return $user->checkPermissionAccess('role_destroy');
    }

}
