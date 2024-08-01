<?php

namespace App\Observers;

use App\Models\Admin\Trademark;
use Illuminate\Support\Str;

class TrademarkObserver
{
    public function saving(Trademark $trademark)
    {
        $trademark->name = Str::ucfirst($trademark->name);
        $trademark->slug = Str::slug($trademark->name);
    }
}
