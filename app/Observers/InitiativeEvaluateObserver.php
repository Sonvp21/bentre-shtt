<?php

namespace App\Observers;

use App\Models\Admin\InitiativeEvaluate;
use Illuminate\Support\Str;

class InitiativeEvaluateObserver
{
    public function saving(InitiativeEvaluate $initiativeEvaluate)
    {
        $initiativeEvaluate->name_evaluation = Str::ucfirst($initiativeEvaluate->name_evaluation);
        $initiativeEvaluate->slug = Str::slug($initiativeEvaluate->name);
    }
}
