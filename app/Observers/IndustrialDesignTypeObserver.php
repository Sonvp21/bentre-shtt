<?php

namespace App\Observers;

use App\Models\Admin\IndustrialDesignType;
use Illuminate\Support\Str;

class IndustrialDesignTypeObserver
{
    public function saving(IndustrialDesignType $industrialDesignType)
    {
        $industrialDesignType->name = Str::ucfirst($industrialDesignType->name);
        $industrialDesignType->slug = Str::slug($industrialDesignType->name);
    }
}
