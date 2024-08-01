<?php

namespace App\Policies;

use App\Models\User;

class InitiativeDossierPolicy
{
//tên biến trùng vs database
    public function index(User $user): bool
    {
        return $user->checkPermissionAccess('initiative_dossier_index');
    }

    public function create(User $user): bool
    {
        return $user->checkPermissionAccess('initiative_dossier_create');
    }

    public function edit(User $user): bool
    {
        return $user->checkPermissionAccess('initiative_dossier_edit');
    }

    public function destroy(User $user): bool
    {
        return $user->checkPermissionAccess('initiative_dossier_destroy');
    }

}
