<?php

declare(strict_types=1);

namespace App\Helper;

use App\Helper\Environment;
use Sabre\Uri as SabreUri;

class Uri
{
    private $environment;

    public function __construct(Environment $environment)
    {
        $this->environment = $environment;
    }

    public function build(string $path): string
    {
        return SabreUri\build([
            "scheme" => $this->environment->getScheme(),
            "host" => $this->environment->getHost(),
            "path" => $path
        ]);
    }
}
