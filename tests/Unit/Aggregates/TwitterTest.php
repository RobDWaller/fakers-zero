<?php

namespace Tests\Unit\Aggregates;

use PHPUnit\Framework\TestCase;
use App\Aggregates\Twitter;
use App\Twitter\TwitterOAuth;
use SlimSession\Helper as Session;
use App\Helper\Uri;
use Psr\Http\Message\ServerRequestInterface as Request;
use Mockery as m;

class TwitterTest extends TestCase
{
    public function testTwitter()
    {
        $twitter = new Twitter(
            m::mock(TwitterOAuth::class),
            m::mock(Session::class),
            m::mock(Uri::class)
        );

        $this->assertInstanceOf(Twitter::class, $twitter);
    }

    public function testBuildOAuthUrl()
    {
        $oauth = m::mock(TwitterOAuth::class);
        $oauth->shouldReceive('getOAuthRequestToken')
            ->once()
            ->andReturn(['oauth_token' => '123', 'oauth_token_secret' => 'abc']);

        $oauth->shouldReceive('getOAuthUrl')
            ->with(['oauth_token' => '123'])
            ->once()
            ->andReturn('https://twitter.com');

        $session = m::mock(Session::class);
        $session->shouldReceive('set')
            ->twice();
        
        $uri = m::mock(Uri::class);
        $uri->shouldReceive('build')
            ->with('/authenticate/return')
            ->once()
            ->andReturn('https://fakers.test/authenticate/return');

        $twitter = new Twitter(
            $oauth,
            $session,
            $uri
        );

        $this->assertSame('https://twitter.com', $twitter->buildOAuthUrl());
    }

    public function testGetAccessTokens()
    {
        $oauth = m::mock(TwitterOAuth::class);
        $oauth->shouldReceive('getAccessToken')
            ->with(['oauth_verifier' => '123'])
            ->once()
            ->andReturn(['token' => 'ABC']);

        $session = m::mock(Session::class);
        
        $uri = m::mock(Uri::class);
        
        $twitter = new Twitter(
            $oauth,
            $session,
            $uri
        );

        $request = m::mock(Request::class);
        $request->shouldReceive('getQueryParams')
            ->once()
            ->andReturn(['oauth_verifier' => '123']);

        $this->assertSame($twitter->getAccessTokens($request), ['token' => 'ABC']);
    }

    public function tearDown(): void
    {
        m::close();
    }
}
