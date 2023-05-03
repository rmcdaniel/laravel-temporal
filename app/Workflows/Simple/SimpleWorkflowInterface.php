<?php

declare(strict_types=1);

namespace App\Workflows\Simple;

use Temporal\Workflow\WorkflowInterface;
use Temporal\Workflow\WorkflowMethod;

#[WorkflowInterface]
interface SimpleWorkflowInterface
{
    public const WORKFLOW_ID = 'simple-workflow';

    #[WorkflowMethod]
    public function execute();
}
