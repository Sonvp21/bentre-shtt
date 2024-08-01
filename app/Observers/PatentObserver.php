<?php

namespace App\Observers;

use App\Models\Admin\Patent;
use Illuminate\Support\Str;

class PatentObserver
{
    public function saving(Patent $patent)
    {
        $patent->name = Str::ucfirst($patent->name);
        $patent->slug = Str::slug($patent->name);
    }
}
