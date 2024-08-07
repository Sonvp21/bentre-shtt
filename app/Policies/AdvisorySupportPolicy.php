<?php

namespace App\Policies;

use App\Models\User;

class AdvisorySupportPolicy
{
//tên biến trùng vs database
    public function index(User $user): bool
    {
        return $user->checkPermissionAccess('advisory_support_index');
    }

    public function create(User $user): bool
    {
        return $user->checkPermissionAccess('advisory_support_create');
    }

    public function edit(User $user): bool
    {
        return $user->checkPermissionAccess('advisory_support_edit');
    }

    public function destroy(User $user): bool
    {
        return $user->checkPermissionAccess('advisory_support_destroy');
    }

}
