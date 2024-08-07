<?php

namespace App\Policies;

use App\Models\User;

class TechnicalInnovationCommitteePolicy
{
//tên biến trùng vs database
    public function index(User $user): bool
    {
        return $user->checkPermissionAccess('technical_innovation_committee_index');
    }

    public function create(User $user): bool
    {
        return $user->checkPermissionAccess('technical_innovation_committee_create');
    }

    public function edit(User $user): bool
    {
        return $user->checkPermissionAccess('technical_innovation_committee_edit');
    }

    public function destroy(User $user): bool
    {
        return $user->checkPermissionAccess('technical_innovation_committee_destroy');
    }

}
