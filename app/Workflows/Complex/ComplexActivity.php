<?php

declare(strict_types=1);

namespace App\Workflows\Complex;

class ComplexActivity implements ComplexActivityInterface
{
    public function complex()
    {
        return 'activity';
    }
}
