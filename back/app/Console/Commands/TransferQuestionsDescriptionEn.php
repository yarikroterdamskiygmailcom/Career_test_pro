<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Model\QuestionDescription;


class TransferQuestionsDescriptionEn extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'transfer:questions-description-en';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Transfer questions_description table - english';

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
        $path = base_path('resources/oldcsv/questions.csv');
        $data = array_map('str_getcsv', file($path));
        $i = 1;

        foreach($data as $row) {
            $inputs = ['question_id' => $i, 'question' => $row[6], 'language_id' => '1'];
            QuestionDescription::create($inputs);
            $i++;
        }
    }
}
