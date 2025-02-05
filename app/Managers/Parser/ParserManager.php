<?php

namespace App\Managers\Parser;

use App\Drivers\CsvParser;
use Illuminate\Support\Manager;

/**
 * The ParserManager class to load the required driver class 
 */
class ParserManager extends Manager
{
    public function getDefaultDriver(): mixed
    {
        return 'json';
    }

    public function createCsvDriver(): CsvParser
    {
        return new CsvParser();
    }

}