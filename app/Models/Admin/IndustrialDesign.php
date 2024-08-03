<?php

namespace App\Models\Admin;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Carbon;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class IndustrialDesign extends Model implements HasMedia
{
    use HasFactory, SoftDeletes, InteractsWithMedia;

    protected $table = 'industrial_designs';

    protected $fillable = [
        'district_id',
        'commune_id',
        'user_id',
        'geom',
        'type_id',

        'name',
        'description',
        'owner',
        'address',

        'filing_number',
        'filing_date',

        'publication_number',
        'publication_date',

        'registration_number',
        'registration_date',
        'expiration_date',

        'designer',
        'designer_address',

        'locarno_classes',

        'representative_name',
        'representative_address',
        
        'status',
    ];

    protected $spatialFields = [
        'geom',
    ];
    protected $dates = ['deleted_at'];
    // Các mối quan hệ
    public function images()
    {
        return $this->hasMany(Image::class);
    }

    public function documents()
    {
        return $this->hasMany(Document::class);
    }

    public function district()
    {
        return $this->belongsTo(District::class);
    }

    public function commune()
    {
        return $this->belongsTo(Commune::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function type()
    {
        return $this->belongsTo(IndustrialDesignType::class, 'type_id');
    }

    public function registerMediaConversions(?Media $media = null): void
    {
        $this->addMediaConversion('lg')
            ->crop(900, 800)
            ->sharpen(5)
            ->format('jpg')
            ->performOnCollections('design_image');

        $this->addMediaConversion('md')
            ->crop(541, 320)
            ->sharpen(5)
            ->format('jpg')
            ->performOnCollections('design_image');

        $this->addMediaConversion('thumb')
            ->crop(368, 276)
            ->sharpen(10)
            ->format('jpg')
            ->performOnCollections('design_image');
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('design_image')
            ->singleFile()
            ->useDisk('design');
    }

    protected function submissionAtVi(): Attribute
    {
        return Attribute::make(
            get: fn () => Carbon::parse($this->submission_date)->format('d.m.Y h:i'),
        );
    }

    protected function publicationAtVi(): Attribute
    {
        return Attribute::make(
            get: fn () => Carbon::parse($this->publication_date)->format('d.m.Y h:i'),
        );
    }

    public function getSubmissionStatusTextAttribute()
    {
        $status = [
            1 => '<span class="text-black">Đang xử lý</span>',
            2 => '<span class="text-green-500">Đã cấp</span>',
            3 => '<span class="text-red-500">Bị từ chối</span>',
        ];

        return $status[$this->submission_status] ?? '';
    }

    public function getDesignStatusTextAttribute()
    {
        $status = [
            1 => '<span class="text-black">Hiệu lực</span>',
            2 => '<span class="text-yellow-400">Hết hạn</span>',
            3 => '<span class="text-red-500">Bị huỷ</span>',
        ];

        return $status[$this->design_status] ?? '';
    }
}
