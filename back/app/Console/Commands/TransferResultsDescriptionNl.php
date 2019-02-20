<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Model\ResultDescription;


class TransferResultsDescriptionNl extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'transfer:results-description-nl';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Transfer results_description table - dutch';

    /**
     * Create a new command instance.
     *
     * @return void
     */

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */

    public function handle()
    {
        $path = base_path('resources/oldcsv/results.csv');
        $handle = fopen($path, "r");
        $i = 1;

        while (($row = fgetcsv($handle, 0, ';')) !== FALSE) {
            $inputs = ['result_id' => $i, 'text' => $row[1], 'language_id' => '5'];
            ResultDescription::create($inputs);
            $i++;
        }
    }
}
