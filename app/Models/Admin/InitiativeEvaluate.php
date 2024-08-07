<?php

namespace App\Models\Admin;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Carbon;
class InitiativeEvaluate extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'initiative_dossier_id',
        'name_evaluation',
        'name_member',
        'score',
        'submission_date',
        'submission_status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function dossier()
    {
        return $this->belongsTo(InitiativeDossier::class, 'initiative_dossier_id');
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
