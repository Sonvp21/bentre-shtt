<?php

namespace App\Policies;

use App\Models\User;

class InitiativePolicy
{
//tên biến trùng vs database
    public function index(User $user): bool
    {
        return $user->checkPermissionAccess('initiative_index');
    }

    public function create(User $user): bool
    {
        return $user->checkPermissionAccess('initiative_create');
    }

    public function edit(User $user): bool
    {
        return $user->checkPermissionAccess('initiative_edit');
    }

    public function destroy(User $user): bool
    {
        return $user->checkPermissionAccess('initiative_destroy');
    }

}
