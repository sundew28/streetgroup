<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Facades\Parser;

class parsecsv extends Command
{  
    /**
     * The path of the csv file. Hard coded for technical task purpose.
     *
     * @var string
     */
    protected $csvPath = 'public/sample.csv';

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'parse:csv';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Parse CSV file and display output';

    /**
     * Execute the console command.
     */
    public function handle()
    {        
        // rescue -- try catch exception handler.
        rescue(function () {
            // parse the csv data.
            $result = Parser::driver('csv')->parse($this->csvPath);
            
            // Output the array result into a neat table of results.
            $this->table(
                ['Title', 'FirstName', 'Initial', 'LastName'],
                $result
            );
        }, function () {
            // Output the error.
            $this->error($this->failure());            
        });

    }
}
