<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Model\Result;


class TransferResults extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'transfer:results';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Transfer results table';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    public function replacement($str)
    {
        $tr = [
            'zeer laag' => '1',
            'laag' => '2',
            'onder gemiddeld' => '3',
            'gemiddeld' => '4',
            'boven gemiddeld' => '5',
            'hoog' => '6',
            'zeer hoog' => '7'
        ];

        return strtr($str, $tr);

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
        while (($row = fgetcsv($handle, 0, ';')) !== FALSE) {
            $inputs = ['category_id' => $row[2], 'letter' => $row[4], 'level_id' => $this->replacement($row[5])];
            Result::create($inputs);
        }
    }
}
