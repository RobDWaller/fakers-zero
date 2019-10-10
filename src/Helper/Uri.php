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
        return $this->isHttps() || $this->isPort443() ? 'https' : 'http';
    }

    private function isHttps(): bool
    {
        return !empty($this->environment['HTTPS'])
        && $this->environment['HTTPS'] !== 'off';
    }

    private function isPort443(): bool
    {
        return isset($this->environment['SERVER_PORT'])
        && $this->environment['SERVER_PORT'] === '443';
    }
}
