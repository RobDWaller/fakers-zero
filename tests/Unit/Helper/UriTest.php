<?php

namespace Tests\Unit\Helper;

use PHPUnit\Framework\TestCase;
use App\Helper\Uri;
use App\Helper\Environment;

class UriTest extends TestCase
{
    public function testUri()
    {
        $config = [];

        $environment = new Environment($config);

        $uri = new Uri($environment);

        $this->assertInstanceOf(Uri::class, $uri);
    }

    public function testBuild()
    {
        $config = ['HTTP_HOST' => 'fakers.com'];

        $environment = new Environment($config);

        $uri = new Uri($environment);

        $url = $uri->build('/authenticate');

        $this->assertSame('http://fakers.com/authenticate', $url);
    }
}
