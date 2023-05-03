<?php

declare(strict_types=1);

namespace App\Workflows\Simple;

use Temporal\Activity\ActivityInterface;
use Temporal\Activity\ActivityMethod;

#[ActivityInterface]
interface SimpleActivityInterface
{
    #[ActivityMethod]
    public function simple();
}
