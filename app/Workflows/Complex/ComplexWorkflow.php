<?php

declare(strict_types=1);

namespace App\Workflows\Complex;

use Carbon\CarbonInterval;
use Finite\StatefulInterface;
use Finite\StateMachine\StateMachine;
use Finite\State\State;
use Finite\State\StateInterface;
use Illuminate\Support\Facades\Log;
use Temporal\Activity\ActivityOptions;
use Temporal\Workflow;
use Temporal\Workflow\QueryMethod;
use Temporal\Workflow\SignalMethod;
use Temporal\Workflow\WorkflowInterface;
use Temporal\Workflow\WorkflowMethod;

#[WorkflowInterface]
class ComplexWorkflow implements ComplexWorkflowInterface, StatefulInterface
{
    private $state;
    private $stateMachine;

    private $complexActivity;
    private $complexOtherActivity;

    public function setFiniteState($state)
    {
        $this->state = $state;
    }

    public function getFiniteState()
    {
        return $this->state;
    }

    #[SignalMethod]
    public function submit()
    {
        $this->stateMachine->apply('submit');
    }

    #[SignalMethod]
    public function approve()
    {
        $this->stateMachine->apply('approve');
    }

    #[SignalMethod]
    public function deny()
    {
        $this->stateMachine->apply('deny');
    }

    #[QueryMethod]
    public function state()
    {
        return $this->stateMachine->getCurrentState()->getName();
    }

    #[QueryMethod]
    public function isSubmitted()
    {
        return $this->stateMachine->getCurrentState()->getName() === 'submitted';
    }

    #[QueryMethod]
    public function isApproved()
    {
        return $this->stateMachine->getCurrentState()->getName() === 'approved';
    }

    #[QueryMethod]
    public function isDenied()
    {
        return $this->stateMachine->getCurrentState()->getName() === 'denied';
    }

    public function __construct()
    {
        $this->complexActivity = Workflow::newActivityStub(
            ComplexActivityInterface::class,
            ActivityOptions::new()->withStartToCloseTimeout(CarbonInterval::seconds(5))
        );
        $this->complexOtherActivity = Workflow::newActivityStub(
            ComplexOtherActivityInterface::class,
            ActivityOptions::new()->withStartToCloseTimeout(CarbonInterval::seconds(5))
        );

        $this->stateMachine = new StateMachine();

        $this->stateMachine->addState(new State('created', StateInterface::TYPE_INITIAL));
        $this->stateMachine->addState('submitted');
        $this->stateMachine->addState(new State('approved', StateInterface::TYPE_FINAL));
        $this->stateMachine->addState(new State('denied', StateInterface::TYPE_FINAL));

        $this->stateMachine->addTransition('submit', 'created', 'submitted');
        $this->stateMachine->addTransition('approve', 'submitted', 'approved');
        $this->stateMachine->addTransition('deny', 'submitted', 'denied');

        $this->stateMachine->setObject($this);
        $this->stateMachine->initialize();
    }

    #[WorkflowMethod]
    public function execute()
    {
        yield Workflow::await(fn () => $this->isSubmitted());

        yield $this->complexActivity->complex();

        yield Workflow::await(fn () => $this->isApproved() || $this->isDenied());

        yield $this->complexOtherActivity->other('other_activity');

        return $this->stateMachine->getCurrentState()->getName();
    }
}
