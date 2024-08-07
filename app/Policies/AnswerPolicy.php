<?php

namespace App\Policies;

use App\Models\User;

class AnswerPolicy
{
//tên biến trùng vs database
    public function index(User $user): bool
    {
        return $user->checkPermissionAccess('answer_index');
    }

    public function create(User $user): bool
    {
        return $user->checkPermissionAccess('answer_create');
    }

    public function edit(User $user): bool
    {
        return $user->checkPermissionAccess('answer_edit');
    }

    public function destroy(User $user): bool
    {
        return $user->checkPermissionAccess('answer_destroy');
    }

}
