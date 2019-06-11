<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Model\Setting;

class TransferSettings extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'transfer:settings';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Transfer settings table';

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
        $path = base_path('resources/oldcsv/settings.csv');
        $handle = fopen($path, "r");
        while (($row = fgetcsv($handle, 0, ';')) !== FALSE) {
            $inputs = ['keyname' => $row[1]];
            Setting::create($inputs);
        }
    }
}
