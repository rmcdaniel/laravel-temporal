<?php

namespace App\Console\Commands;

// use App\Workflows\SyncEventsWorkflow;
// use App\Workflows\AggregateEventsActivity;
// use App\Workflows\CleanupEventsActivity;
// use App\Workflows\StoreEventsActivity;
use Illuminate\Console\Command;
use Temporal\WorkerFactory;

class TemporalWork extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'temporal:work';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Start processing temporal workflows as a daemon';

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
     * @return int
     */
    public function handle()
    {
        $factory = WorkerFactory::create();

        $worker = $factory->newWorker();

        // $worker->registerWorkflowTypes(SyncEventsWorkflow::class);

        // $worker->registerActivity(AggregateEventsActivity::class);
        // $worker->registerActivity(StoreEventsActivity::class);
        // $worker->registerActivity(CleanupEventsActivity::class);

        $factory->run();

        return 0;
    }
}
