<?php

declare(strict_types=1);

namespace App\Workflows\Simple;

class SimpleOtherActivity implements SimpleOtherActivityInterface
{
    public function execute(string $string)
    {
        return $string;
    }
}
