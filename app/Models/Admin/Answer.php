<?php

namespace App\Models\Admin;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Carbon;

class Answer extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'question_id', 'user_id', 'responder', 'answer', 'answer_date', 'view', 'status'
    ];

    public function question()
    {
        return $this->belongsTo(Question::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    protected function answerDateAtVi(): Attribute
    {
        return Attribute::make(
            get: fn () => Carbon::parse($this->answer_date)->format('d.m.Y h:i'),
        );
    }

    public function statusColor(): string
    {
        return $this->status == 1 ? 'bg-green-500' : 'bg-red-500';
    }
}
