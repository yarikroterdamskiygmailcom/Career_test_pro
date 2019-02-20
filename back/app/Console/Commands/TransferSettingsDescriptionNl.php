<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Model\SettingDescription;


class TransferSettingsDescriptionNl extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'transfer:setting-description-nl';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Transfer setting_description table - dutch';

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
            $inputs = ['setting_id' => $i, 'value' => $row[2], 'language_id' => '5'];
            SettingDescription::create($inputs);
            $i++;
        }
    }
}
