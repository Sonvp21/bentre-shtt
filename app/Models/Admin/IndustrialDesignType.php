<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class IndustrialDesignType extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'industrial_design_types';

    protected $fillable = [
        'name'
    ];

    protected $dates = ['deleted_at'];

    public function industrial_designs()
    {
        return $this->hasMany(IndustrialDesign::class, 'type_id');
    }
}
