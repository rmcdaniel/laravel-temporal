<?php

declare(strict_types=1);

namespace App\Workflows\Simple;

class SimpleActivity implements SimpleActivityInterface
{
    public function execute()
    {
        return 'activity';
    }
}
