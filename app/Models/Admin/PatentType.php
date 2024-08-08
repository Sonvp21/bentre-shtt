<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PatentType extends Model
{
    use HasFactory;

    protected $table = 'patent_types';

    protected $fillable = [
        'name'
    ];

    public function patents()
    {
        return $this->hasMany(Patent::class, 'type_id');
    }
}
