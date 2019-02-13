<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Model\CareerSingleDescription;


class TransferCareersSingleDescriptionNl extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'transfer:careers-single-description-nl';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Transfer careers_single_description table - dutch';

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
        $path = base_path('resources/oldcsv/careers_single.csv');
        $data = array_map('str_getcsv', file($path));
        $i = 1;

        foreach($data as $row) {
            $inputs = ['career_single_id' => $i, 'career' => $row[1], 'language_id' => '5'];
            CareerSingleDescription::create($inputs);
            $i++;
        }

    }
}
