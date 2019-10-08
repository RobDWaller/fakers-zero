<?php

declare(strict_types=1);

namespace App\Helper;

use Sabre\Uri as SabreUri;

class Uri
{
    private $environment;

    public function __construct($environment)
    {
        $this->environment = $environment;
    }

    public function build(string $path): string
    {
        return SabreUri\build([
            "scheme" => $this->getScheme(),
            "host" => $this->getHost(),
            "path" => $path
        ]);
    }

    public function getHost(): string
    {
        if (isset($this->environment['HTTP_HOST'])) {
            return $this->environment['HTTP_HOST'];
        }

        if (isset($this->environment['SERVER_NAME'])) {
            return $this->environment['SERVER_NAME'];
        }

        return '';
    }

    public function getScheme(): string
    {
        if (
            (!empty($this->environment['HTTPS'])
            && $this->environment['HTTPS'] !== 'off')
            || $this->environment['SERVER_PORT'] === '443'
        ) {
            return 'https';
        }

        return 'http';
    }
}
