<?php

namespace App\Observers;

use App\Models\Admin\Product;
use Illuminate\Support\Str;

class ProductObserver
{
    public function saving(Product $product)
    {
        $product->name = Str::ucfirst($product->name);
        $product->slug = Str::slug($product->name);
    }
}
