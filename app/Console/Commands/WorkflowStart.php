<?php

namespace App\Console\Commands;

use App\Workflows\Complex\ComplexWorkflowInterface;
use App\Workflows\Simple\SimpleWorkflowInterface;
use App\Workflows\Versioned\VersionedWorkflowInterface;
use Exception;
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
    protected $signature = 'workflow:start {workflow}';

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
        switch ($this->argument('workflow')) {
            case 'complex':
                $class = ComplexWorkflowInterface::class;
                break;
            case 'simple':
                $class = SimpleWorkflowInterface::class;
                break;
            case 'versioned':
                $class = VersionedWorkflowInterface::class;
                break;

            default:
                throw new Exception('Unknown workflow.');
                break;
        }

        $workflow = $this->workflowClient->newWorkflowStub(
            $class,
            WorkflowOptions::new()->withWorkflowId($class === VersionedWorkflowInterface::class ? $class::WORKFLOW_ID . random_int(100, 999) : $class::WORKFLOW_ID)
        );

        try {
            $this->workflowClient->start($workflow);
        } catch (\Throwable $th) {
            $this->info('already running');
        }

        return 0;
    }
}
