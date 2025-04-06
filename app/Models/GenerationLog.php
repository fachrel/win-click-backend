<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class GenerationLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'prompts',
        'email',
        'user_id',
        'aspect_ratio',
        'status',
        'message',
        'generated_image_count',
        'seed',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}