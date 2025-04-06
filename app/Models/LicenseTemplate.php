<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LicenseTemplate extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'license_templates';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'license_type',
        'max_devices',
        'application',
        'daily_generation_limit',
        'workers',
        'version',
        'active_days',
        'price',
        'is_trial',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'max_devices' => 'integer',
        'daily_generation_limit' => 'integer',
        'workers' => 'integer',
        'is_trial' => 'boolean',
        'active_days' => 'integer',
        'price' => 'decimal:2',
    ];
}