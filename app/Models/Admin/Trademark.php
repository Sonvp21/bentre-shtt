<?php

namespace App\Models\Admin;

use App\Models\Admin\Commune;
use App\Models\Admin\District;
use App\Models\Admin\TrademarkType;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Carbon;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Haruncpi\LaravelUserActivity\Traits\Loggable;

class Trademark extends Model implements HasMedia
{
    use SoftDeletes, InteractsWithMedia, Loggable;

    protected $table = 'trademarks';

    protected $fillable = [
        'district_id',
        'commune_id',
        'user_id',
        'geom',
        'lat',
        'lon',
        'color',
        'name',
        'slug',
        'description',
        'type_id',
        'owner',
        'address',
        'contact',
        'application_number',
        'submission_date',
        'submission_status',
        'publication_number',
        'publication_date',
        'out_of_date',
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
        return $this->belongsTo(TrademarkType::class, 'type_id');
    }

    public function registerMediaConversions(?Media $media = null): void
    {
        $this->addMediaConversion('lg')
            ->crop(900, 800)
            ->sharpen(5)
            ->format('jpg')
            ->performOnCollections('trademark_image');

        $this->addMediaConversion('md')
            ->crop(541, 320)
            ->sharpen(5)
            ->format('jpg')
            ->performOnCollections('trademark_image');

        $this->addMediaConversion('thumb')
            ->crop(368, 276)
            ->sharpen(10)
            ->format('jpg')
            ->performOnCollections('trademark_image');
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('trademark_image')
            ->singleFile()
            ->useDisk('trademark');
    }

    // protected function submissionAtVi(): Attribute
    // {
    //     return Attribute::make(
    //         get: fn () => Carbon::parse($this->submission_date)->format('d.m.Y h:i'),
    //     );
    // }

    public function getSubmissionStatusTextAttribute()
    {
        $status = [
            1 => '<span class="text-black">Đang xử lý</span>',
            2 => '<span class="text-green-500">Đã cấp</span>',
            3 => '<span class="text-red-500">Bị từ chối</span>',
        ];

        return $status[$this->submission_status] ?? '';
    }
}
