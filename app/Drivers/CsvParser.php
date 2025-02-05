<?php

namespace App\Drivers;

use Illuminate\Support\Facades\Storage;
use App\Interface\Parser\ParserInterface;
use Illuminate\Support\Str;
use Illuminate\Support\Collection;

final class CsvParser implements ParserInterface
{
    /**
     * To grab the data from csv file.
     *
     * @var string
     */
    protected string $csvOutput;

    /**
     * To get values to an array
     *
     * @var array
     */
    protected array $outputArray;

    /**
     * Parse the csv file data.
     *
     * @return Collection     
     */
    public function parse(string $path): Collection
    {        
        $this->csvOutput = Storage::disk('local')->get($path);

        // 1. Split by new line. Use the PHP_EOL constant for cross-platform compatibility.
        $lines = explode(PHP_EOL, $this->csvOutput);

        // 2. Extract the header and convert it into a Laravel collection.
        $header = collect(str_getcsv(array_shift($lines)));

        // 3. Convert the rows into a Laravel collection and replace characters.
        $rows = Str::replace("&", "and",collect($lines)->filter());
       
        $i=0;

        // loop through the rows
        foreach($rows as $value) {

            $results = [];                       
            
            // split the data into array items.
            preg_match('#^(\w+\.?)?\s*([\'\’\w\.?]+)\s+([\'\-\w]+)\s*(\w+\.?)?$#', $value, $results);           
           
            if(count($results) <= 4 && !empty($results)) {

                $this->outputArray[$i]['title'] = $results[1];

                if(strpbrk($results[2], '.') !== false){
                    $this->outputArray[$i]['firstname'] = "";
                    $this->outputArray[$i]['initial'] = Str::of($results[2])->trim('.')->toString();                    
                } else {
                    $this->outputArray[$i]['firstname'] = $results[2];
                    $this->outputArray[$i]['initial'] = "";                    
                }
                
                $this->outputArray[$i]['lastname'] = $results[3];
                $i++;

            } elseif(count($results) <= 5 && !empty($results)) {
                $this->outputArray[$i]['title'] = $results[1];                
                $this->outputArray[$i]['firstname'] = "";
                $this->outputArray[$i]['initial'] = "";
                $this->outputArray[$i]['lastname'] = $results[4];
                $i++;
                $this->outputArray[$i]['title'] = $results[3];
                $this->outputArray[$i]['firstname'] = "";
                $this->outputArray[$i]['initial'] = "";
                $this->outputArray[$i]['lastname'] = $results[4];
                $i++;
            } elseif (empty($results) && !empty($value)){
                $explodeValue = Str::of($value)->explode("and");

                if(Str::of($explodeValue[0])->wordCount()>1){
                    foreach($explodeValue as $values){
                        $values = Str::of($values)->trim();                        
                        $extractvalues =[];
                        preg_match('#^(\w+\.?)?\s*([\'\’\w\.?]+)\s+([\'\-\w]+)\s*(\w+\.?)?$#', $values, $extractvalues);
                        $this->outputArray[$i]['title'] = $extractvalues[1];                
                        $this->outputArray[$i]['firstname'] = $extractvalues[2];
                        $this->outputArray[$i]['initial'] = "";
                        $this->outputArray[$i]['lastname'] = $extractvalues[3];
                        $i++;
                    }
                } 
            }          
        }
        // return the collection of data.
        return collect($this->outputArray);        
    }

}
