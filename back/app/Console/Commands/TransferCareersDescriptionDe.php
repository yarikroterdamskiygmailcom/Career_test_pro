<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Model\CareerDescription;


class TransferCareersDescriptionDe extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'transfer:careers-description-de';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Transfer careers_description table - german';

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
            $inputs = ['career_id' => $i, 'career' => $row[6], 'language_id' => '3'];
            CareerDescription::create($inputs);
            $i++;
        }

    }
}
