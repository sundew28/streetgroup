<?php

namespace App\Interface\Parser;
use Illuminate\Support\Collection;

/**
 * return Collection
 */
{
    public function parse(string $path): Collection;
}