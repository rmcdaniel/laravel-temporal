<?php

declare(strict_types=1);

namespace App\Workflows\Versioned;

use Temporal\Workflow\WorkflowInterface;
use Temporal\Workflow\WorkflowMethod;

#[WorkflowInterface]
interface VersionedWorkflowInterface
{
    public const WORKFLOW_ID = 'versioned-workflow';

    #[WorkflowMethod]
    public function execute();
}
