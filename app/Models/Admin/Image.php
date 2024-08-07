<?php

namespace App\Models\Admin;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;
    protected $fillable = [
        'file_path',
        'file_name',

        'user_id',
        'patent_id',
        'trademark_id',
        'industrial_design_id',
        'geographical_indication_id',
        'product_id',
        'advisory_support_id',
    ];

    // Các mối quan hệ
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function patent()
    {
        return $this->belongsTo(Patent::class);
    }

    public function trademark()
    {
        return $this->belongsTo(Trademark::class);
    }

    public function industrialDesign()
    {
        return $this->belongsTo(industrialDesign::class);
    }

    public function geographicalIndication()
    {
        return $this->belongsTo(GeographicalIndication::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function advisorySupport()
    {
        return $this->belongsTo(AdvisorySupport::class);
    }
}
