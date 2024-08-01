<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Carbon;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class TechnicalInnovationDossier extends Model implements HasMedia
{
    use HasFactory, SoftDeletes, InteractsWithMedia;

    protected $fillable = [
        'name', 'unit_name', 'field', 'submission_date', 'submission_status'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected function submissionAtVi(): Attribute
    {
        return Attribute::make(
            get: fn () => Carbon::parse($this->submission_date)->format('d.m.Y h:i'),
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

    // Relationships
    public function committees()
    {
        return $this->hasMany(TechnicalInnovationCommittee::class, 'technical_id', 'id');
    }

    public function results()
    {
        return $this->hasMany(TechnicalInnovationResult::class, 'technical_id', 'id');
    }
}
