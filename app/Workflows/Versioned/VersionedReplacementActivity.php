<?php

declare(strict_types=1);

namespace App\Workflows\Versioned;

class VersionedReplacementActivity implements VersionedReplacementActivityInterface
{
    public function replacement()
    {
        return 'replacement_activity';
    }
}
