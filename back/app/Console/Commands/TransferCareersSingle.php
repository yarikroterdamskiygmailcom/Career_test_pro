<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Model\CareerSingle;


class TransferCareersSingle extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'transfer:careers-single';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Transfer careers_single table';

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

        foreach($data as $row) {
            $inputs = ['letter' => $row[2]];
            CareerSingle::create($inputs);
        }

    }
}
