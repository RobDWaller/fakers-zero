<?php

namespace Tests\Unit\Helper;

use PHPUnit\Framework\TestCase;
use App\Helper\Uri;

class UriTest extends TestCase
{
    public function testUri()
    {
        $environment = [];

        $uri = new Uri($environment);

        $this->assertInstanceOf(Uri::class, $uri);
    }

    public function testBuild()
    {
        $environment = ['HTTP_HOST' => 'fakers.com'];

        $uri = new Uri($environment);

        $url = $uri->build('/authenticate');

        $this->assertSame('http://fakers.com/authenticate', $url);
    }

    public function testGetHost()
    {
        $environment = ['HTTP_HOST' => 'fakers.com'];

        $uri = new Uri($environment);

        $this->assertSame($uri->getHost(), 'fakers.com');
    }

    public function testGetHostWithServerName()
    {
        $environment = ['SERVER_NAME' => 'fakers.com'];

        $uri = new Uri($environment);

        $this->assertSame($uri->getHost(), 'fakers.com');
    }

    public function testGetHostNone()
    {
        $environment = [];

        $uri = new Uri($environment);

        $this->assertSame($uri->getHost(), '');
    }

    public function testGetHostWithBoth()
    {
        $environment = [
            'HTTP_HOST' => 'fakers.com',
            'SERVER_NAME' => 'two.fakers.com'
        ];

        $uri = new Uri($environment);

        $this->assertSame($uri->getHost(), 'fakers.com');
    }

    public function testGetScheme()
    {
        $environment = [];

        $uri = new Uri($environment);

        $this->assertSame($uri->getScheme(), 'http');
    }

    public function testGetSchemeSecure()
    {
        $environment = ['HTTPS' => 'on'];

        $uri = new Uri($environment);

        $this->assertSame($uri->getScheme(), 'https');
    }

    public function testGetSchemeSecurePort()
    {
        $environment = ['SERVER_PORT' => "443"];

        $uri = new Uri($environment);

        $this->assertSame($uri->getScheme(), 'https');
    }

    public function testGetSchemeOff()
    {
        $environment = ['HTTPS' => "off"];

        $uri = new Uri($environment);

        $this->assertSame($uri->getScheme(), 'http');
    }
}
