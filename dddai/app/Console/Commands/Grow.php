<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use DB;
class Grow extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'grow';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'zhangli';

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
        $today=date('Y-m-d');
        $tasks=DB::table('tasks')->where('enddate','>=', $today)->get();

        foreach($tasks as $task){
            $task->paytime = $today;
            $task =(array)$task;
            unset($task['tid']);
            unset($task['enddate']);
            DB::table('grows')->insert($task);           
        }
         $this->info(date('Y/m/d').'grow done');
    }
}
