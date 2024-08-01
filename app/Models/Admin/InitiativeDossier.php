<?php

namespace App\Models\Admin;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Carbon;
class InitiativeDossier extends Model implements HasMedia
{
    use HasFactory, SoftDeletes, InteractsWithMedia;

    protected $fillable = [
        'user_id',
        'initiative_id',
        'name',
        'submission_date',
        'submission_status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function initiative()
    {
        return $this->belongsTo(Initiative::class);
    }

    public function evaluations()
    {
        return $this->hasMany(InitiativeEvaluate::class);
    }

    protected function submissionAtVi(): Attribute
    {
        return Attribute::make(
            get: fn () => Carbon::parse($this->submission_date)->format('d.m.Y h:i'),
        );
    }

    public function getSubmissionStatusTextAttribute()
    {
        $status = [
            1 => '<span class="text-black">Đang chờ xử lý</span>',
            2 => '<span class="text-blue-500">Đang được xem xét</span>',
            3 => '<span class="text-green-500">Được phê duyệt</span>',
            4 => '<span class="text-red-500">Bị từ chối</span>',
        ];

        return $status[$this->submission_status] ?? '';
    }
}
