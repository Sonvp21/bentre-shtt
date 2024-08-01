<?php

namespace App\Policies;

use App\Models\User;

class QuestionPolicy
{
//tên biến trùng vs database
    public function index(User $user): bool
    {
        return $user->checkPermissionAccess('question_index');
    }

    public function create(User $user): bool
    {
        return $user->checkPermissionAccess('question_create');
    }

    public function edit(User $user): bool
    {
        return $user->checkPermissionAccess('question_edit');
    }

    public function destroy(User $user): bool
    {
        return $user->checkPermissionAccess('question_destroy');
    }

}
