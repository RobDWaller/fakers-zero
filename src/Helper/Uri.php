<?php

declare(strict_types=1);

namespace App\Helper;

use Sabre\Uri as SabreUri;

class Uri
{
    public function build(array $input): string
    {
        return SabreUri\build($input);
    }
}
