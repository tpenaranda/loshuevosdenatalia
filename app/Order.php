<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\{BelongsTo, BelongsToMany};
use Illuminate\Database\Eloquent\{Model, SoftDeletes};

class Order extends Model
{
    use SoftDeletes;

    const STATUS_CREATED = 'created';
    const STATUS_DELIVERED = 'delivered';
    const STATUS_PREPARED = 'prepared';

    const STATUSES = [
        0 => self::STATUS_CREATED,
        5 => self::STATUS_PREPARED,
        10 => self::STATUS_DELIVERED,
    ];

    protected $fillable = [
        'notes',
    ];

    protected $hidden = [
        'created_at',
        'deleted_at',
        'updated_at',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'deleted_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function skus(): BelongsToMany
    {
        return $this->belongsToMany(Sku::class)->withPivot('data')->using(OrderSku::class);
    }
}
