<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\Relations\{BelongsTo};
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Custom Pivot Model for relating a report with plans
 */
class OrderSku extends Pivot
{
    use SoftDeletes;

    protected $fillable = [
        'data',
    ];

    protected $hidden = [
        'deleted_at',
    ];

    protected $casts = [
        'data' => 'array',
        'deleted_at' => 'datetime',
    ];

    public function order(): BelongsTo
    {
        return $this->belongsTo(order::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
