<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Model\ReportBlockDescription;


class TransferReportBlocksDescriptionEn extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'transfer:report-blocks-description-en';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fill report_blocks_description table';

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
            $inputs = ['report_block_id' => $row[1], 'value' => $row[2], 'letter' => $row[3], 'language_id' => '1'];
            ReportBlockDescription::create($inputs);
        }
    }
}
