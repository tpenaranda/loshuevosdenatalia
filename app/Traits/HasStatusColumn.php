<?php

namespace App\Traits;

use App\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Schema;

trait HasStatusColumn
{
    protected function getStatusColumn()
    {
        return empty($this->statusColumnName) ? 'status' : $this->statusColumnName;
    }

    public function getStatusAttribute()
    {
        $value = $this->attributes[$this->getStatusColumn()];

        return empty(self::STATUSES[$value]) ? null : self::STATUSES[$value];
    }

    public function setStatusAttribute($value)
    {
        if (false !== ($key = array_search($value, self::STATUSES))) {
            $this->attributes[$this->getStatusColumn()] = $key;
        }

        return $value;
    }

    public function scopeStatus(Builder $builder, string $status_string): Builder
    {
        $status_int = array_search($status_string, self::STATUSES);

        return $builder->where($this->getStatusColumn(), $status_int);
    }
}
