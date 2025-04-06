<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class License extends Model
{
    protected $fillable = [
        'user_id',
        'license_key',
        'devices_mac',
        'max_devices',
        'valid_until',
        'application',
        'status',
        'purchase_date',
        'activation_date',
        'notes',
        'license_type',
        'version',
        'active_days',
        'is_trial'
    ];

    protected $casts = [
        'devices_mac' => 'array',
        'valid_until' => 'datetime',
        'purchase_date' => 'datetime',
        'activation_date' => 'datetime',
        'is_trial' => 'boolean',
    ];

        /**
     * Get the user that owns the License.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
