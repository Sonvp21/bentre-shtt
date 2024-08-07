<?php

namespace App\Services;

use App\Models\Video;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;

class VideoService
{
    public function getcachedVideosForHome(): Collection
    {
        return $this->cachedVideosForHome();
    }

    public function cachedVideosForHome(): Collection
    {
        return Cache::rememberForever('videos', function () {
            return Video::query()
                ->orderBy('updated_at')->get();
        });
    }

    public function deletecachedVideosForHome(): void
    {
        Cache::forget('videos');
    }
}
