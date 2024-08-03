<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;
    protected $fillable = [
        'file_path',
        'file_name',
        
        'patent_id',
        'trademark_id',
        'industrial_design_id',
        'initiative_dossier_id',
        'geographical_indication_id',
        'product_id',
        'advisory_support_id',
        'infringement_id',
        'technical_innovation_dossier_id',
        'technical_innovation_result_id',
    ];

    // Các mối quan hệ
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
        return $this->belongsTo(IndustrialDesign::class);
    }

    public function initiativeDossier()
    {
        return $this->belongsTo(InitiativeDossier::class);
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

    public function infringement()
    {
        return $this->belongsTo(Infringement::class);
    }

    public function technicalInnovationDossier()
    {
        return $this->belongsTo(TechnicalInnovationDossier::class);
    }

    public function technicalInnovationResult()
    {
        return $this->belongsTo(TechnicalInnovationResult::class);
    }
}
