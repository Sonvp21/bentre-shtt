<?php

namespace App\Policies;

use App\Models\User;

class PermissionPolicy
{
//tên biến trùng vs database
    public function index(User $user): bool
    {
        return $user->checkPermissionAccess('permission_index');
    }

    public function create(User $user): bool
    {
        return $user->checkPermissionAccess('permission_create');
    }

    public function edit(User $user): bool
    {
        return $user->checkPermissionAccess('permission_edit');
    }

    public function destroy(User $user): bool
    {
        return $user->checkPermissionAccess('permission_destroy');
    }

}
