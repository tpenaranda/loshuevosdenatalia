<?php

namespace App;

use Redis;

class Store
{
    public function open($open = true): self
    {
        Redis::set('is_store_open', $open);

        return $this;
    }

    public function close($close = true): self
    {
        return $this->open(!$close);
    }

    public function isClosed(): bool
    {
        return empty(Redis::get('is_store_open'));
    }

    public function isOpen(): bool
    {
        return !$this->isClosed();
    }

    public function __toString(): string
    {
        return json_encode([
            'open' => $this->isOpen(),
        ]);
    }
}
