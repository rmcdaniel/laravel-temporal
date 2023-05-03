<?php

declare(strict_types=1);

namespace App\Workflows\Simple;

use Temporal\Activity\ActivityInterface;
use Temporal\Activity\ActivityMethod;

#[ActivityInterface]
interface SimpleOtherActivityInterface
{
    #[ActivityMethod]
    public function execute(string $string);
}
