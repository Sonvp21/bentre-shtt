<?php

namespace App\Policies;

use App\Models\User;

class PatentTypePolicy
{
//tên biến trùng vs database
    public function index(User $user): bool
    {
        return $user->checkPermissionAccess('patent_types_index');
    }

    public function create(User $user): bool
    {
        return $user->checkPermissionAccess('patent_types_create');
    }

    public function edit(User $user): bool
    {
        return $user->checkPermissionAccess('patent_types_edit');
    }

    public function destroy(User $user): bool
    {
        return $user->checkPermissionAccess('patent_types_destroy');
    }

}
