<?php

namespace App\Policies;

use App\Models\User;

class TrademarkPolicy
{
//tên biến trùng vs database
    public function index(User $user): bool
    {
        return $user->checkPermissionAccess('trademark_index');
    }

    public function create(User $user): bool
    {
        return $user->checkPermissionAccess('trademark_create');
    }

    public function edit(User $user): bool
    {
        return $user->checkPermissionAccess('trademark_edit');
    }

    public function destroy(User $user): bool
    {
        return $user->checkPermissionAccess('trademark_destroy');
    }

}
