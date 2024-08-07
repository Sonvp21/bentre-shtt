<?php

namespace App\Policies;

use App\Models\User;

class InfringementPolicy
{
//tên biến trùng vs database
    public function index(User $user): bool
    {
        return $user->checkPermissionAccess('infringement_index');
    }

    public function create(User $user): bool
    {
        return $user->checkPermissionAccess('infringement_create');
    }

    public function edit(User $user): bool
    {
        return $user->checkPermissionAccess('infringement_edit');
    }

    public function destroy(User $user): bool
    {
        return $user->checkPermissionAccess('infringement_destroy');
    }

}
