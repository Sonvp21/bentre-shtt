<?php

namespace App\Policies;

use App\Models\User;

class InitiativeEvaluatePolicy
{
//tên biến trùng vs database
    public function index(User $user): bool
    {
        return $user->checkPermissionAccess('initiative_evaluate_index');
    }

    public function create(User $user): bool
    {
        return $user->checkPermissionAccess('initiative_evaluate_create');
    }

    public function edit(User $user): bool
    {
        return $user->checkPermissionAccess('initiative_evaluate_edit');
    }

    public function destroy(User $user): bool
    {
        return $user->checkPermissionAccess('initiative_evaluate_destroy');
    }

}
