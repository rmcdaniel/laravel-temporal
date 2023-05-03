<?php

declare(strict_types=1);

namespace App\Workflows\Complex;

use Temporal\Workflow\QueryMethod;
use Temporal\Workflow\SignalMethod;
use Temporal\Workflow\WorkflowInterface;
use Temporal\Workflow\WorkflowMethod;

#[WorkflowInterface]
interface ComplexWorkflowInterface
{
    public const WORKFLOW_ID = 'complex-workflow';

    #[SignalMethod]
    public function submit();

    #[SignalMethod]
    public function approve();

    #[SignalMethod]
    public function deny();

    #[QueryMethod]
    public function state();

    #[QueryMethod]
    public function isSubmitted();

    #[QueryMethod]
    public function isApproved();

    #[QueryMethod]
    public function isDenied();

    #[WorkflowMethod]
    public function execute();
}
