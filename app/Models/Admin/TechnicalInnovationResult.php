<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TechnicalInnovationResult extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'technical_id', 'year', 'rank', 'status'
    ];

    // Các mối quan hệ
    public function documents()
    {
        return $this->hasMany(Document::class);
    }
    public function dossier()
    {
        return $this->belongsTo(TechnicalInnovationDossier::class, 'technical_id');
    }
}
