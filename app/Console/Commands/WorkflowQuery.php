<?php

namespace App\Console\Commands;

use App\Workflows\Complex\ComplexWorkflowInterface;
use Illuminate\Console\Command;
use Temporal\Client\GRPC\ServiceClient;
use Temporal\Client\WorkflowClient;
use Temporal\Client\WorkflowOptions;

class WorkflowQuery extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'workflow:query {method}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get data from a workflow';

    private WorkflowClient $workflowClient;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(WorkflowClient $workflowClient)
    {
        parent::__construct();

        $this->workflowClient = $workflowClient;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        try {
            $workflow = $this->workflowClient->newRunningWorkflowStub(ComplexWorkflowInterface::class, 'complex-workflow');

            // $workflow->state()
            $this->info($workflow->{$this->argument('method')}());
        } catch (\Throwable $th) {
            $this->info('not running');
        }

        return 0;
    }
}
