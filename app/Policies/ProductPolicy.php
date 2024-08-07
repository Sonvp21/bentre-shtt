<?php

namespace App\Policies;

use App\Models\User;

class ProductPolicy
{
//tên biến trùng vs database
    public function index(User $user): bool
    {
        return $user->checkPermissionAccess('product_index');
    }

    public function create(User $user): bool
    {
        return $user->checkPermissionAccess('product_create');
    }

    public function edit(User $user): bool
    {
        return $user->checkPermissionAccess('product_edit');
    }

    public function destroy(User $user): bool
    {
        return $user->checkPermissionAccess('product_destroy');
    }

}
