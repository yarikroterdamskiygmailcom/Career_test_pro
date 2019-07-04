<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Model\Report;


class TransferReport extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'transfer:report';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Transfer rapport table';

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
        $path = base_path('resources/oldcsv/rapport.csv');
        $handle = fopen($path, "r");
        while (($row = fgetcsv($handle, 0, ';')) !== FALSE) {
            $inputs = ['strip' => $row[1], 'key' => $row[2], 'position' => $row[4]];
            Report::create($inputs);
        }
    }
}
