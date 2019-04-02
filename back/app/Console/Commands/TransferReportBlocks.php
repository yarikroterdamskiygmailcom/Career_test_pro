<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Model\ReportBlock;


class TransferReportBlocks extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'transfer:report-blocks';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fill report_block table';

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
        $path = base_path('resources/oldcsv/report_blocks.csv');
        //$data = array_map('str_getcsv', file($path), [';']);
        $data   = array_map(function($datas) { return str_getcsv($datas,"\t"); }, file($path));

        foreach($data as $row) {
            $inputs = ['name' => $row[0]];
            ReportBlock::create($inputs);
        }

    }
}
