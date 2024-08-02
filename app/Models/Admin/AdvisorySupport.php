<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Carbon;
class AdvisorySupport extends Model implements HasMedia
{
    use HasFactory, SoftDeletes, InteractsWithMedia;

    protected $fillable = [
        'title',
        'content',
        'status',
        'published_at',
        'parent_id',
    ];
    protected $dates = [
        'published_at',
    ];
    public function parent()
    {
        return $this->belongsTo(AdvisorySupport::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(AdvisorySupport::class, 'parent_id');
    }
    /**
     * Register the conversions that should be performed.
     *
     * @param  \Spatie\MediaLibrary\Conversions\Conversion  $media
     * @return void
     */
    public function registerMediaCollections(): void
    {
        $this
            ->addMediaCollection('image_support')
            ->useDisk('support')
            ->singleFile();
    }

    protected function publishedAtVi(): Attribute
    {
        return Attribute::make(
            get: fn () => Carbon::parse($this->published_at)->format('d.m.Y h:i'),
        );
    }
}
