<?php

declare(strict_types=1);

namespace App\Workflows\Simple;

class SimpleOtherActivity implements SimpleOtherActivityInterface
{
    public function other(string $string)
    {
        return 'other_activity';
    }
}
