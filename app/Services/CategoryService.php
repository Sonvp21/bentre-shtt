<?php

namespace App\Services;

use App\Models\Category;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;

class CategoryService
{
    // public function getCachedCategoriesForMenu(): Collection
    // {
    //     return $this->cachedCategoriesForMenu();
    // }

    // public function cachedCategoriesForMenu(): Collection
    // {
    //     return Cache::rememberForever('categories_menu', function () {
    //         return Category::query()
    //             ->with('children')
    //             ->whereNull('parent_id')
    //             ->where('in_menu', true)
    //             ->orderBy('order')->get();
    //     });
    // }

    public function deleteCachedCategoriesForMenu(): void
    {
        Cache::forget('categories_menu');
    }
}
