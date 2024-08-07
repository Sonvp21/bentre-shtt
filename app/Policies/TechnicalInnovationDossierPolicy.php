<?php

namespace App\Policies;

use App\Models\User;

class TechnicalInnovationDossierPolicy
{
//tên biến trùng vs database
    public function index(User $user): bool
    {
        return $user->checkPermissionAccess('technical_innovation_dossier_index');
    }

    public function create(User $user): bool
    {
        return $user->checkPermissionAccess('technical_innovation_dossier_create');
    }

    public function edit(User $user): bool
    {
        return $user->checkPermissionAccess('technical_innovation_dossier_edit');
    }

    public function destroy(User $user): bool
    {
        return $user->checkPermissionAccess('technical_innovation_dossier_destroy');
    }

}
