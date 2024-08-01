<?php

namespace App\Policies;

use App\Models\User;

class TechnicalInnovationResultPolicy
{
//tên biến trùng vs database
    public function index(User $user): bool
    {
        return $user->checkPermissionAccess('technical_innovation_result_index');
    }

    public function create(User $user): bool
    {
        return $user->checkPermissionAccess('technical_innovation_result_create');
    }

    public function edit(User $user): bool
    {
        return $user->checkPermissionAccess('technical_innovation_result_edit');
    }

    public function destroy(User $user): bool
    {
        return $user->checkPermissionAccess('technical_innovation_result_destroy');
    }

}
