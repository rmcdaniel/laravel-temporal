<?php

declare(strict_types=1);

namespace App\Workflows\Versioned;

class VersionedActivity implements VersionedActivityInterface
{
    public function versioned()
    {
        return 'activity';
    }
}
