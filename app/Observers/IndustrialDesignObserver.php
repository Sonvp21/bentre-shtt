<?php

namespace App\Observers;

use App\Models\Admin\IndustrialDesign;
use Illuminate\Support\Str;

class IndustrialDesignObserver
{
    public function saving(IndustrialDesign $industrialDesign)
    {
        $industrialDesign->name = Str::ucfirst($industrialDesign->name);
        $industrialDesign->slug = Str::slug($industrialDesign->name);
    }
}
