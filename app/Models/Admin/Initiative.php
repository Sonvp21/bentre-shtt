<?php

namespace App\Models\Admin;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Initiative extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'user_id',
        'name',
        'author',
        'owner',
        'address',
        'fields',
        'recognition_year',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function dossiers()
    {
        return $this->hasMany(InitiativeDossier::class);
    }

    public function getStatusTextAttribute()
    {
        $status = [
            1 => '<span class="text-black">Đang chờ xử lý</span>',
            2 => '<span class="text-blue-500">Đang được xem xét</span>',
            3 => '<span class="text-green-500">Được phê duyệt</span>',
            4 => '<span class="text-red-500">Bị từ chối</span>',
            5 => '<span class="text-yellow-500">Đã triển khai</span>',
            6 => '<span class="text-gray-500">Hết hạn</span>',
            7 => '<span class="text-gray-500">Đã rút</span>',
        ];

        return $status[$this->status] ?? '';
    }
}
