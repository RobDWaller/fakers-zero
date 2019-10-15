<?php

namespace Tests\Unit\Helper;

use PHPUnit\Framework\TestCase;
use App\Helper\Environment;
use ReflectionMethod;

class EnvironmentTest extends TestCase
{
    public function testEnvironment()
    {
        $environment = new Environment([]);

        $this->assertInstanceOf(Environment::class, $environment);
    }

    public function testGetHost()
    {
        $config = ['HTTP_HOST' => 'fakers.com'];

        $environment = new Environment($config);

        $this->assertSame($environment->getHost(), 'fakers.com');
    }

    public function testGetHostWithServerName()
    {
        $config = ['SERVER_NAME' => 'fakers.com'];

        $environment = new Environment($config);

        $this->assertSame($environment->getHost(), 'fakers.com');
    }

    public function testGetHostNone()
    {
        $config = [];

        $environment = new Environment($config);

        $this->assertSame($environment->getHost(), '');
    }

    public function testGetHostWithBoth()
    {
        $config = [
            'HTTP_HOST' => 'fakers.com',
            'SERVER_NAME' => 'two.fakers.com'
        ];

        $environment = new Environment($config);

        $this->assertSame($environment->getHost(), 'fakers.com');
    }

    public function testGetScheme()
    {
        $config = [];

        $environment = new Environment($config);

        $this->assertSame($environment->getScheme(), 'http');
    }

    public function testGetSchemeSecure()
    {
        $config = ['HTTPS' => 'on'];

        $environment = new Environment($config);

        $this->assertSame($environment->getScheme(), 'https');
    }

    public function testGetSchemeSecurePort()
    {
        $config = ['SERVER_PORT' => "443"];

        $environment = new Environment($config);

        $this->assertSame($environment->getScheme(), 'https');
    }

    public function testGetSchemeOff()
    {
        $config = ['HTTPS' => "off"];

        $environment = new Environment($config);

        $this->assertSame($environment->getScheme(), 'http');
    }

    public function testIsHttps()
    {
        $config = ['HTTPS' => "on"];

        $environment = new Environment($config);

        $method = new ReflectionMethod(Environment::class, 'isHttps');
        $method->setAccessible(true);

        $this->assertTrue($method->invoke($environment));
    }

    public function testIsHttpsFalse()
    {
        $config = ['HTTPS' => "off"];

        $environment = new Environment($config);

        $method = new ReflectionMethod(Environment::class, 'isHttps');
        $method->setAccessible(true);

        $this->assertFalse($method->invoke($environment));
    }

    public function testIsHttpsNotSet()
    {
        $config = [];

        $environment = new Environment($config);

        $method = new ReflectionMethod(Environment::class, 'isHttps');
        $method->setAccessible(true);

        $this->assertFalse($method->invoke($environment));
    }

    public function testIsPort443False()
    {
        $config = ['SERVER_PORT' => "80"];

        $environment = new Environment($config);

        $method = new ReflectionMethod(Environment::class, 'isPort443');
        $method->setAccessible(true);

        $this->assertFalse($method->invoke($environment));
    }

    public function testIsPort443NotSet()
    {
        $config = [];

        $environment = new Environment($config);

        $method = new ReflectionMethod(Environment::class, 'isPort443');
        $method->setAccessible(true);

        $this->assertFalse($method->invoke($environment));
    }

    public function testGetTokenSecret()
    {
        $config = ['FAKERS_SECRET' => '22343'];

        $environment = new Environment($config);

        $this->assertSame($environment->getTokenSecret(), '22343');
    }

    public function testGetTokenExpiry()
    {
        $config = ['FAKERS_EXPIRY' => '30'];

        $environment = new Environment($config);

        $this->assertSame($environment->getTokenExpiry(), 30);
    }
}