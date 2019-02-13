<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Model\Career;


class TransferCareers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'transfer:careers';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Transfer careers table';

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

        foreach($data as $row) {
            $inputs = ['code' => $row[1], 'training' => $row[3], 'level' => $row[4], 'education' => $row[5]];
            Career::create($inputs);
        }

    }
}
