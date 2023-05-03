<?php

declare(strict_types=1);

namespace App\Workflows\Complex;

use Temporal\Activity\ActivityInterface;
use Temporal\Activity\ActivityMethod;

#[ActivityInterface]
interface ComplexActivityInterface
{
    #[ActivityMethod]
    public function complex();
}
