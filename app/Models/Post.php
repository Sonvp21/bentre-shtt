<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;

class Post extends Model implements HasMedia, Searchable
{
    use HasFactory;
    use InteractsWithMedia;

    protected $table = 'posts';

    protected $fillable = ['user_id', 'category_id', 'title', 'slug', 'content', 'published_at', 'title_en', 'content_en'];

    protected $casts = [
        'published_at' => 'datetime:Y-m-d H:i:s',
    ];

    //search for web
    public function getSearchResult(): SearchResult
    {
        $url = route('categories.posts.show', ['category' => $this->category->slug, 'post' => $this->slug]);

        return new SearchResult(
            $this,
            $this->title,
            $url
        );
    }

    /*
    * -------------------------------------------------------------------------------------
    * RELATIONSHIPS
    * -------------------------------------------------------------------------------------
    */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'post_tags');
    }

    public function registerMediaConversions(?Media $media = null): void
    {
        $this->addMediaConversion('lg')
            ->crop(900, 800)
            ->sharpen(5)
            ->format('jpg')
            ->performOnCollections('featured_image');

        $this->addMediaConversion('md')
            ->crop(541, 320)
            ->sharpen(5)
            ->format('jpg')
            ->performOnCollections('featured_image');

        $this->addMediaConversion('thumb')
            ->crop(368, 276)
            ->sharpen(10)
            ->format('jpg')
            ->performOnCollections('featured_image');
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('featured_image')
            ->singleFile()
            ->useDisk('post');
    }

    /*
    * -------------------------------------------------------------------------------------
    * SCOPES
    * -------------------------------------------------------------------------------------
    */
    public function scopePublished($query)
    {
        return $query->whereDate('published_at', '<=', now());
    }

    public function scopeexcludeCurrent($query, $id)
    {
        return $query->whereNotIn('id', [$id]);
    }

    /*
    * -------------------------------------------------------------------------------------
    * ACCESSOR & MUTATOR
    * -------------------------------------------------------------------------------------
    */
    public function publishedAtVi(): Attribute
    {
        return Attribute::make(
            get: fn () => Carbon::parse($this->published_at)->translatedFormat('l, d/m/Y'),
        );
    }

    protected function updatedAtVi(): Attribute
    {
        return Attribute::make(
            get: fn () => Carbon::parse($this->updated_at)->format('d.m.Y h:i'),
        );
    }

    protected function publishedPostDate(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->published_at->translatedFormat('l, d/m/Y'),
        );
    }

    protected function publishedPostDateThumb(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->published_at->diffForHumans(),
        );
    }

    public function getPublishedDateAttribute()
    {
        return Carbon::parse($this->published_at)->format('M d, Y H:i');
    }

    public function getPublishedDateSearchAttribute()
    {
        return Carbon::parse($this->published_at)->diffForHumans();
    }

    protected function publishedAt(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => \Carbon\Carbon::parse($value)->format('Y-m-d H:i:s'),
        );
    }
}
