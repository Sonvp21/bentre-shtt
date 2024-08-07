<?php

namespace App\Observers;

use App\Models\Admin\Initiative;
use Illuminate\Support\Str;

class InitiativeObserver
{
    public function saving(Initiative $initiative)
    {
        $initiative->name = Str::ucfirst($initiative->name);
        $initiative->slug = Str::slug($initiative->name);
    }
}
