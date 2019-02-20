<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Model\SettingDescription;


class TransferSettingsDescriptionEn extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'transfer:setting-description-en';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Transfer setting_description table - english';

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
        $i = 1;

        while (($row = fgetcsv($handle, 0, ';')) !== FALSE) {
            $inputs = ['setting_id' => $i, 'value' => $row[5], 'language_id' => '1'];
            SettingDescription::create($inputs);
            $i++;
        }
    }
}
