<?php

namespace App\Policies;

use App\Models\User;

class TrademarkTypePolicy
{
//tên biến trùng vs database
    public function index(User $user): bool
    {
        return $user->checkPermissionAccess('trademark_type_index');
    }

    public function create(User $user): bool
    {
        return $user->checkPermissionAccess('trademark_type_create');
    }

    public function edit(User $user): bool
    {
        return $user->checkPermissionAccess('trademark_type_edit');
    }

    public function destroy(User $user): bool
    {
        return $user->checkPermissionAccess('trademark_type_destroy');
    }

}
