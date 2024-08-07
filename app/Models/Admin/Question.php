<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Carbon;

class Question extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name_sender', 'email', 'title', 'content', 'question_date', 'status'
    ];

    public function answers()
    {
        return $this->hasMany(Answer::class);
    }

    protected function questionDateAtVi(): Attribute
    {
        return Attribute::make(
            get: fn () => Carbon::parse($this->question_date)->format('d.m.Y h:i'),
        );
    }

    public function statusColor(): string
    {
        return $this->status == 1 ? 'bg-green-500' : 'bg-red-500';
    }
}
