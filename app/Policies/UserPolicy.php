<?php

namespace App\Policies;

use App\Models\User;

class UserPolicy
{
//tên biến trùng vs database
    public function index(User $user): bool
    {
        return $user->checkPermissionAccess('user_index');
    }

    public function create(User $user): bool
    {
        return $user->checkPermissionAccess('user_create');
    }

    public function edit(User $user): bool
    {
        return $user->checkPermissionAccess('user_edit');
    }

    public function destroy(User $user): bool
    {
        return $user->checkPermissionAccess('user_destroy');
    }

}
