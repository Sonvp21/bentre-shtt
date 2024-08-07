<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TechnicalInnovationCommittee extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'technical_id', 'name', 'score', 'date', 'status'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'date' => 'datetime',
    ];

    // Relationships
    public function dossier()
    {
        return $this->belongsTo(TechnicalInnovationDossier::class, 'technical_id', 'id');
    }
}
