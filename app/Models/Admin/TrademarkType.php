<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TrademarkType extends Model
{
    use SoftDeletes;

    protected $table = 'trademark_types';

    protected $fillable = [
        'name'
    ];

    protected $dates = ['deleted_at'];

    public function trademarks()
    {
        return $this->hasMany(Trademark::class, 'type_id');
    }
}
