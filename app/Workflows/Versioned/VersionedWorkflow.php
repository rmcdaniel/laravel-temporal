<?php

declare(strict_types=1);

namespace App\Workflows\Versioned;

use Carbon\CarbonInterval;
use Temporal\Activity\ActivityOptions;
use Temporal\Workflow;

#[Workflow\WorkflowInterface]
class VersionedWorkflow implements VersionedWorkflowInterface
{
    private $VersionedActivity;
    private $VersionedOtherActivity;

    public function __construct()
    {
        $this->versionedActivity = Workflow::newActivityStub(
            VersionedActivityInterface::class,
            ActivityOptions::new()->withStartToCloseTimeout(CarbonInterval::seconds(5))
        );
        $this->versionedReplacementActivity = Workflow::newActivityStub(
            VersionedReplacementActivityInterface::class,
            ActivityOptions::new()->withStartToCloseTimeout(CarbonInterval::seconds(5))
        );
        $this->versionedOtherActivity = Workflow::newActivityStub(
            VersionedOtherActivityInterface::class,
            ActivityOptions::new()->withStartToCloseTimeout(CarbonInterval::seconds(5))
        );
    }

    #[Workflow\WorkflowMethod]
    public function execute()
    {
        // $version = yield Workflow::getVersion('versionedActivity', Workflow::DEFAULT_VERSION, 1);

        yield Workflow::timer('1 minute');

        // if ($version === Workflow::DEFAULT_VERSION) {
            $result = yield $this->versionedActivity->versioned();
        // } else {
        //     $result = yield $this->versionedReplacementActivity->replacement();
        // }

        $otherResult = yield $this->versionedOtherActivity->other('other_activity');

        return 'workflow_' . $result . '_' . $otherResult;
    }
}
