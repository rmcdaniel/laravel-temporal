<?php

namespace App\Console\Commands;

use App\Workflows\Simple\SimpleWorkflowInterface;
use Illuminate\Console\Command;
use Temporal\Client\GRPC\ServiceClient;
use Temporal\Client\WorkflowClient;
use Temporal\Client\WorkflowOptions;

class WorkflowStart extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'workflow:start';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new workflow and start it running';

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
        $workflow = $this->workflowClient->newWorkflowStub(
            SyncEventsWorkflowInterface::class,
            WorkflowOptions::new()->withWorkflowId(SimpleWorkflowInterface::WORKFLOW_ID)
        );

        try {
            $this->workflowClient->start($workflow);
        } catch (\Throwable $th) {
            $this->info('already running');
        }

        return 0;
    }
}
