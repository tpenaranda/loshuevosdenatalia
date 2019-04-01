<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\{BelongsTo, BelongsToMany};
use Illuminate\Database\Eloquent\{Model, SoftDeletes};

class Order extends Model
{
    use SoftDeletes;

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
