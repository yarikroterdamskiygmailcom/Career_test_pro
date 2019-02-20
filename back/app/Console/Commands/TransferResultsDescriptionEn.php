<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Model\ResultDescription;


class TransferResultsDescriptionEn extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'transfer:results-description-en';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Transfer results_description table - english';

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
            $inputs = ['result_id' => $i, 'text' => $row[8], 'language_id' => '1'];
            ResultDescription::create($inputs);
            $i++;
        }
    }
}
