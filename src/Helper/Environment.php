<?php

declare(strict_types=1);

namespace App\Helper;

class Environment
{
    private $config;

    public function __construct(array $config)
    {
        $this->config = $config;
    }

    public function getHost(): string
    {
        if (isset($this->config['HTTP_HOST'])) {
            return $this->config['HTTP_HOST'];
        }

        if (isset($this->config['SERVER_NAME'])) {
            return $this->config['SERVER_NAME'];
        }

        return '';
    }

    public function getScheme(): string
    {
        return $this->isHttps() || $this->isPort443() ? 'https' : 'http';
    }

    private function isHttps(): bool
    {
        return !empty($this->config['HTTPS'])
        && $this->config['HTTPS'] !== 'off';
    }

    private function isPort443(): bool
    {
        return isset($this->config['SERVER_PORT'])
        && $this->config['SERVER_PORT'] === '443';
    }

    public function getTokenSecret(): string
    {
        return $this->config['FAKERS_SECRET'] ?? '';
    }

    public function getTokenExpiry(): int
    {
        return isset($this->config['FAKERS_EXPIRY']) ? (int) $this->config['FAKERS_EXPIRY']: 0;
    }
}