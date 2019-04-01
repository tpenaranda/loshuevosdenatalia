<?php

namespace App;

use App\Traits\HasSlugColumn;
use Illuminate\Database\Eloquent\{Model, SoftDeletes};

class Sku extends Model
{
    use HasSlugColumn, SoftDeletes;

    protected $fillable = [
        'name',
        'price',
        'slug',
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
}
