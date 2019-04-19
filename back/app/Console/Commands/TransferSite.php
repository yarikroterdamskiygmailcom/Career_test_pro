<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Model\Site;


class TransferSite extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'transfer:site';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fill site table';

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
        $path = base_path('resources/oldcsv/site_blocks.csv');
        //$data = array_map('str_getcsv', file($path), [';']);
        $data   = array_map(function($datas) { return str_getcsv($datas,"\t"); }, file($path));

        foreach($data as $row) {
            $inputs = ['name' => $row[0]];
            Site::create($inputs);
        }
    }
}
