<?php

namespace App\Traits;

use Illuminate\Contracts\Support\Arrayable;

trait HasSlugColumn
{
    public static function find($id, $columns = ['*'])
    {
        if (is_string($id) && !is_numeric($id)) {
            return self::whereSlug($id)->first($columns);
        }

        if (is_array($id) || $id instanceof Arrayable) {
            return self::findMany($id, $columns);
        }

        return self::whereKey($id)->first($columns);
    }
}
