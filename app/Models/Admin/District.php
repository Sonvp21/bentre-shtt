<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class District extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $fillable = [
        'name',
        'area',
        'population',
        'updated_year',
    ];
    protected $table = 'districts';
    protected $primaryKey = 'id';
    public $incrementing = false;

    public function communes()
    {
        return $this->hasMany(Commune::class, 'district_id', 'id');
    }

    public function patents()
    {
        return $this->hasMany(Patent::class);
    }

    public function trademarks()
    {
        return $this->hasMany(Trademark::class);
    }

    public function industrialdesigns()
    {
        return $this->hasMany(IndustrialDesign::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function geographical_indications()
    {
        return $this->hasMany(GeographicalIndication::class);
    }
}
