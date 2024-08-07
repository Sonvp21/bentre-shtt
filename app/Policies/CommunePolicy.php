<?php

namespace App\Policies;

use App\Models\User;

class CommunePolicy
{
//tên biến trùng vs database
    public function index(User $user): bool
    {
        return $user->checkPermissionAccess('commune_index');
    }

    public function create(User $user): bool
    {
        return $user->checkPermissionAccess('commune_create');
    }

    public function edit(User $user): bool
    {
        return $user->checkPermissionAccess('commune_edit');
    }

    public function destroy(User $user): bool
    {
        return $user->checkPermissionAccess('commune_destroy');
    }

}
