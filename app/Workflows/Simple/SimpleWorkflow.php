<?php

declare(strict_types=1);

namespace App\Workflows\Simple;

use Carbon\CarbonInterval;
use Temporal\Activity\ActivityOptions;
use Temporal\Workflow;

#[Workflow\WorkflowInterface]
class SimpleWorkflow implements SimpleWorkflowInterface
{
    private $simpleActivity;
    private $simpleOtherActivity;

    public function __construct()
    {
        $this->simpleActivity = Workflow::newActivityStub(
            AggregateEventsActivityInterface::class,
            ActivityOptions::new()->withStartToCloseTimeout(CarbonInterval::seconds(5))
        );
        $this->simpleOtherActivity = Workflow::newActivityStub(
            StoreEventsActivityInterface::class,
            ActivityOptions::new()->withStartToCloseTimeout(CarbonInterval::seconds(5))
        );
    }

    #[Workflow\WorkflowMethod]
    public function execute()
    {
        $result = yield $this->simpleActivity->execute();

        $otherResult = yield $this->simpleOtherActivity->execute('other_activity');

        return 'workflow_' . $result . '_' . $otherResult;
    }
}
