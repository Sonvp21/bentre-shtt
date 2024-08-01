<?php

namespace App\Models\Admin;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Carbon;

class Product extends Model implements HasMedia
{
    use HasFactory, SoftDeletes, InteractsWithMedia;

    protected $fillable = [
        'district_id',
        'commune_id',
        'user_id',
        'name',
        'slug',
        'owner',
        'address',
        'contact',
        'representatives',
        'status',
    ];
    public function registerMediaCollections(): void
    {
        // Bộ sưu tập hình ảnh
        $this
            ->addMediaCollection('image_product')
            ->useDisk('product')
            ->singleFile();
        $this
            ->addMediaCollection('document_product')
            ->useDisk('product')
            ->singleFile();
    }
    
    public function district()
    {
        return $this->belongsTo(District::class);
    }

    /**
     * Get the commune that owns the product.
     */
    public function commune()
    {
        return $this->belongsTo(Commune::class);
    }

    /**
     * Get the user that owns the product.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    protected function submissionAtVi(): Attribute
    {
        return Attribute::make(
            get: fn () => Carbon::parse($this->issue_date)->format('d.m.Y h:i'),
        );
    }
}