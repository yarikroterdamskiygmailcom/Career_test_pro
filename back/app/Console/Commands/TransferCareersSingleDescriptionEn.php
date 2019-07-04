<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Model\CareerSingleDescription;


class TransferCareersSingleDescriptionEn extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'transfer:careers-single-description-en';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Transfer careers_single_description table - english';

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
            $inputs = ['career_single_id' => $i, 'career' => $row[5], 'language_id' => '1'];
            CareerSingleDescription::create($inputs);
            $i++;
        }

    }
}
