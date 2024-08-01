<?php

namespace App\Observers;

use App\Models\Admin\TrademarkType;
use Illuminate\Support\Str;

class TrademarkTypeObserver
{
    public function saving(TrademarkType $trademarkType)
    {
        $trademarkType->name = Str::ucfirst($trademarkType->name);
        $trademarkType->slug = Str::slug($trademarkType->name);
    }
}
