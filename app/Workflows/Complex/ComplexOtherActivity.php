<?php

declare(strict_types=1);

namespace App\Workflows\Complex;

class ComplexOtherActivity implements ComplexOtherActivityInterface
{
    public function other(string $string)
    {
        return 'other_activity';
    }
}
