<?php

declare(strict_types=1);

namespace App\Workflows\Simple;

class SimpleOtherActivity implements SimpleOtherActivityInterface
{
    public function execute()
    {
        return 'other_activity';
    }
}
