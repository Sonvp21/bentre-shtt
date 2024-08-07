<?php

namespace App\Policies;

use App\Models\User;

class GeographicalIndicationPolicy
{
//tên biến trùng vs database
    public function index(User $user): bool
    {
        return $user->checkPermissionAccess('geographical_indication_index');
    }

    public function create(User $user): bool
    {
        return $user->checkPermissionAccess('geographical_indication_create');
    }

    public function edit(User $user): bool
    {
        return $user->checkPermissionAccess('geographical_indication_edit');
    }

    public function destroy(User $user): bool
    {
        return $user->checkPermissionAccess('geographical_indication_destroy');
    }

}
