<?php

namespace App\Policies;

use App\Models\Admin\District;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class DistrictPolicy
{
//tên biến trùng vs database
    public function index(User $user): bool
    {
        return $user->checkPermissionAccess('district_index');
    }

    public function create(User $user): bool
    {
        return $user->checkPermissionAccess('district_create');
    }

    public function edit(User $user): bool
    {
        return $user->checkPermissionAccess('district_edit');
    }

    public function destroy(User $user): bool
    {
        return $user->checkPermissionAccess('district_destroy');
    }

}
