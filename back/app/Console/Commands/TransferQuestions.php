<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Model\Question;


class TransferQuestions extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'transfer:questions';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Transfer questions table';

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

        foreach($data as $row) {
            $inputs = ['category_id' => $row[2], 'letter' => $row[3]];
            Question::create($inputs);
        }

    }
}
