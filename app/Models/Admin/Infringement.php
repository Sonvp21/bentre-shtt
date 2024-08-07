<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Carbon;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Infringement extends Model implements HasMedia
{
    use HasFactory, SoftDeletes, InteractsWithMedia;

    protected $fillable = [
        'name',
        'content',
        'date',
        'penalty_amount',
        'status',
    ];
    // Các mối quan hệ
    public function documents()
    {
        return $this->hasMany(Document::class);
    }
    // Accessor to format the date
    protected function date(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => Carbon::parse($value)->format('d.m.Y h:i'),
        );
    }

    // Accessor for formatted penalty amount
    public function getFormattedPenaltyAmountAttribute()
    {
        return number_format($this->penalty_amount, 0, ',', '.') . ' đ';
    }

    // Accessor for input value
    public function getPenaltyAmountForInputAttribute()
    {
        return number_format($this->penalty_amount, 0, ',', '');
    }
}
