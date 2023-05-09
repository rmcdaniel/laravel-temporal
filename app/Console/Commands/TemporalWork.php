<?php

namespace App\Console\Commands;

use App\Workflows\Complex\ComplexWorkflow;
use App\Workflows\Complex\ComplexActivity;
use App\Workflows\Complex\ComplexOtherActivity;
use App\Workflows\Simple\SimpleWorkflow;
use App\Workflows\Simple\SimpleActivity;
use App\Workflows\Simple\SimpleOtherActivity;
use App\Workflows\Versioned\VersionedWorkflow;
use App\Workflows\Versioned\VersionedActivity;
use App\Workflows\Versioned\VersionedReplacementActivity;
use App\Workflows\Versioned\VersionedOtherActivity;
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

        $worker->registerWorkflowTypes(ComplexWorkflow::class);
        $worker->registerActivity(ComplexActivity::class);
        $worker->registerActivity(ComplexOtherActivity::class);

        $worker->registerWorkflowTypes(SimpleWorkflow::class);
        $worker->registerActivity(SimpleActivity::class);
        $worker->registerActivity(SimpleOtherActivity::class);

        $worker->registerWorkflowTypes(VersionedWorkflow::class);
        $worker->registerActivity(VersionedActivity::class);
        $worker->registerActivity(VersionedReplacementActivity::class);
        $worker->registerActivity(VersionedOtherActivity::class);

        $factory->run();
        return 0;
    }
}
