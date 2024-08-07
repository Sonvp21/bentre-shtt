<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Tonysm\RichTextLaravel\Casts\AsRichTextContent;

class Faq extends Model
{
    use HasFactory;

    protected $table = 'faqs';

    protected $fillable = ['name', 'email', 'phone', 'address', 'question', 'answer', 'read_at', 'answer_at'];

    protected $casts = [
        'question' => AsRichTextContent::class,
    ];

    protected function createdAtVi(): Attribute
    {
        return Attribute::make(
            get: fn () => Carbon::parse($this->created_at)->format('d.m.Y h:i'),
        );
    }
}
