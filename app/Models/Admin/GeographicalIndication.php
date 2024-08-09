<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Carbon;

class GeographicalIndication extends Model implements HasMedia
{
    use HasFactory, SoftDeletes, InteractsWithMedia;

    protected $fillable = [
        'district_id',
        'commune_id',
        'name',
        'management_unit',
        'application_number',
        'certificate_number',
        'issue_date',
        'content',
        'authorized_unit',
        'status',
        'view_count',
    ];

    // Các mối quan hệ
    public function images()
    {
        return $this->hasMany(Image::class);
    }

    public function documents()
    {
        return $this->hasMany(Document::class);
    }
    // Mối quan hệ với model District
    public function district()
    {
        return $this->belongsTo(District::class);
    }

    // Mối quan hệ với model Commune
    public function commune()
    {
        return $this->belongsTo(Commune::class);
    }

    public function registerMediaCollections(): void
    {
        $this
            ->addMediaCollection('image_geographical')
            ->useDisk('geographical')
            ->singleFile();
    }

    public function getIssueDateAttribute($value)
    {
        return $value ? Carbon::parse($value)->format('d.m.Y') : null;
    }
}
