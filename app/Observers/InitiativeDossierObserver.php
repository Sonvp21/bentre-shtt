<?php

namespace App\Observers;

use App\Models\Admin\InitiativeDossier;
use Illuminate\Support\Str;

class InitiativeDossierObserver
{
    public function saving(InitiativeDossier $initiativeDossier)
    {
        $initiativeDossier->name = Str::ucfirst($initiativeDossier->name);
        $initiativeDossier->slug = Str::slug($initiativeDossier->name);
    }
}
