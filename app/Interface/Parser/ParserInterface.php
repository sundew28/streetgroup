<?php

namespace App\Interface\Parser;
use Illuminate\Support\Collection;

interface ParserInterface
{
    public function parse(string $path): Collection;
}