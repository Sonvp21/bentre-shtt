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
use Haruncpi\LaravelUserActivity\Traits\Loggable;

class Patent extends Model implements HasMedia
{
    use HasFactory, SoftDeletes, InteractsWithMedia, Loggable;

    protected $fillable = [
        'district_id',
        'commune_id',
        'user_id',
        'geom',
        'lat',
        'lon',
        'code',
        'name',
        'slug',
        'description',
        'legal_representative',
        'document',
        'application_number',
        'submission_date',
        'submission_status',
        'publication_date',
        'number_patent',
        'patent_date',
        'patent_out_of_date',
        'patent_status',
    ];

    protected $dates = ['deleted_at'];

    public function user()
    {
        return $this->belongsTo(User::class);
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

    public function registerMediaConversions(?Media $media = null): void
    {
        $this->addMediaConversion('lg')
            ->crop(900, 800)
            ->sharpen(5)
            ->format('jpg')
            ->performOnCollections('patent_image');

        $this->addMediaConversion('md')
            ->crop(541, 320)
            ->sharpen(5)
            ->format('jpg')
            ->performOnCollections('patent_image');

        $this->addMediaConversion('thumb')
            ->crop(368, 276)
            ->sharpen(10)
            ->format('jpg')
            ->performOnCollections('patent_image');
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('patent_image')
            ->singleFile()
            ->useDisk('patent');
    }

    // protected function submissionAtVi(): Attribute
    // {
    //     return Attribute::make(
    //         get: fn () => Carbon::parse($this->submission_date)->format('d.m.Y'),
    //     );
    // }

    // Accessor cho submission_date
    public function getSubmissionDateAttribute($value)
    {
        return $value ? Carbon::parse($value)->format('d.m.Y h:i') : null;
    }
    // Accessor cho publication_date
    public function getPublicationDateAttribute($value)
    {
        return $value ? Carbon::parse($value)->format('d.m.Y h:i') : null;
    }

    // Accessor cho patent_date
    public function getPatentDateAttribute($value)
    {
        return $value ? Carbon::parse($value)->format('d.m.Y h:i') : null;
    }

    // Accessor cho patent_out_of_date
    public function getPatentOutOfDateAttribute($value)
    {
        return $value ? Carbon::parse($value)->format('d.m.Y h:i') : null;
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

    // Accessor for patent_status
    public function getPatentStatusTextAttribute()
    {
        $status = [
            1 => '<span class="text-black">Hiệu lực</span>',
            2 => '<span class="text-yellow-400">Hết hạn</span>',
            3 => '<span class="text-red-500">Bị huỷ</span>',
        ];

        return $status[$this->patent_status] ?? '';
    }
}
