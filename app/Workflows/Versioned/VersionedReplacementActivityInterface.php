<?php

declare(strict_types=1);

namespace App\Workflows\Versioned;

use Temporal\Activity\ActivityInterface;
use Temporal\Activity\ActivityMethod;

#[ActivityInterface]
interface VersionedReplacementActivityInterface
{
    #[ActivityMethod]
    public function replacement();
}
