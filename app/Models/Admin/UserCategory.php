<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class UserCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'slug',
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
