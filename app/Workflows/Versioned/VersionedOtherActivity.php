<?php

declare(strict_types=1);

namespace App\Workflows\Versioned;

class VersionedOtherActivity implements VersionedOtherActivityInterface
{
    public function other(string $string)
    {
        return 'other_activity';
    }
}
