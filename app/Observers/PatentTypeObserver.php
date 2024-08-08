<?php

namespace App\Observers;

use App\Models\Admin\PatentType;
use Illuminate\Support\Str;

class PatentTypeObserver
{
    public function saving(PatentType $patentType)
    {
        $patentType->name = Str::ucfirst($patentType->name);
        $patentType->slug = Str::slug($patentType->name);
    }
}
