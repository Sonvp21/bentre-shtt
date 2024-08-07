<?php

namespace App\Policies;

use App\Models\Admin\Patent;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class PatentPolicy
{
//tên biến trùng vs database
    public function index(User $user): bool
    {
        return $user->checkPermissionAccess('patent_index');
    }

    public function create(User $user): bool
    {
        return $user->checkPermissionAccess('patent_create');
    }

    public function edit(User $user): bool
    {
        return $user->checkPermissionAccess('patent_edit');
    }

    public function destroy(User $user): bool
    {
        return $user->checkPermissionAccess('patent_destroy');
    }

}
