<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Token extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'access_token',
        'expires',
        'email',
        'image',
        'name',
        'user_id',
        'visibility',
        'status',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'expires' => 'datetime',
        'public' => 'boolean', // tinyInteger(0) will be cast to false, 1 to true
        'status' => 'boolean', // tinyInteger(0) will be cast to false, 1 to true
    ];

    /**
     * Get the user that owns the token.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'tokens';
}
