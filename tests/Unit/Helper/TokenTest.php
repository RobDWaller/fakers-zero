<?php

namespace Tests\Unit\Helper;

use PHPUnit\Framework\TestCase;
use App\Helper\Token;
use App\Helper\Environment;
use App\Helper\Uri;
use ReallySimpleJWT\Parse;
use ReallySimpleJWT\Validate;
use ReallySimpleJWT\Encode;
use ReallySimpleJWT\Jwt;
use ReallySimpleJWT\Parsed;
use ReflectionMethod;

class TokenTest extends TestCase
{
    public function testToken()
    {
        $config = [];

        $environment = new Environment($config);
        $uri = new Uri($environment);

        $token = new Token($environment, $uri);

        $this->assertInstanceOf(Token::class, $token);
    }

    public function testMake()
    {
        $config = [
            'FAKERS_SECRET' => '123456*ABcdEFGH',
            'FAKERS_EXPIRY' => 900
        ];

        $environment = new Environment($config);
        $uri = new Uri($environment);

        $token = new Token($environment, $uri);

        $this->assertNotEmpty($token->make('231237812312389'));
    }

    public function testMakeValidate()
    {
        $config = [
            'FAKERS_SECRET' => '123456*ABcdEFGH',
            'FAKERS_EXPIRY' => 900
        ];

        $environment = new Environment($config);
        $uri = new Uri($environment);

        $token = new Token($environment, $uri);

        $token = $token->make('213');

        $jwt = new Jwt($token, '123456*ABcdEFGH');

        $parse = new Parse($jwt, new Validate(), new Encode());
    
        $parsed = $parse->validate()
            ->validateExpiration()
            ->parse();

        $this->assertInstanceOf(Parsed::class, $parsed);
    }

    public function testMakeValidateParts()
    {
        $config = [
            'FAKERS_SECRET' => '123456*ABcdEFGH',
            'FAKERS_EXPIRY' => 900,
            'HTTPS' => 'on',
            'HTTP_HOST' => 'fakers.com'
        ];

        $environment = new Environment($config);
        $uri = new Uri($environment);

        $token = new Token($environment, $uri);

        $token = $token->make('4566');

        $jwt = new Jwt($token, '123456*ABcdEFGH');

        $parse = new Parse($jwt, new Validate(), new Encode());
    
        $parsed = $parse->validate()
            ->validateExpiration()
            ->parse();

        $this->assertSame($parsed->getIssuer(), 'fakers.com');
        $this->assertSame($parsed->getAudience(), 'https://fakers.com');
        $this->assertSame($parsed->getPayload()['user_id'], '4566');
    }
}
