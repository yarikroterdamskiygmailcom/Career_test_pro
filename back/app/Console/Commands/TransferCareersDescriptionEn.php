<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Model\CareerDescription;


class TransferCareersDescriptionEn extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'transfer:careers-description-en';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Transfer careers_description table - english';

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
        $path = base_path('resources/oldcsv/careers.csv');
        $data = array_map('str_getcsv', file($path));
        $i = 1;

        foreach($data as $row) {
            $inputs = ['career_id' => $i, 'career' => $row[8], 'language_id' => '1'];
            CareerDescription::create($inputs);
            $i++;
        }

    }
}
