<?php

namespace App\Aggregates;

use Psr\Http\Message\ServerRequestInterface as Request;
use App\Twitter\TwitterOAuth;
use SlimSession\Helper as Session;
use App\Helper\Uri;

class Twitter
{
    private $twitterOAuth;

    private $session;

    private $uri;

    public function __construct(TwitterOAuth $twitterOAuth, Session $session, Uri $uri)
    {
        $this->twitterOAuth = $twitterOAuth;

        $this->session = $session;

        $this->uri = $uri;
    }

    public function buildOAuthUrl(): string
    {
        $token = $this->twitterOAuth->getOAuthRequestToken(
            ['oauth_callback' => $this->uri->build('/authenticate/return')]
        );

        $this->session->set('oauth_token', $token['oauth_token']);
        $this->session->set('oauth_token_secret', $token['oauth_token_secret']);

        return $this->twitterOAuth->getOAuthUrl(['oauth_token' => $token['oauth_token']]);
    }

    public function getAccessTokens(Request $request): array
    {
        $verifier = $request->getQueryParams()['oauth_verifier'] ?? '';
        if (!empty($verifier)) {
            return $this->twitterOAuth->getAccessToken(['oauth_verifier' => $verifier]);
        }

        throw new \Exception('No oauth verifier set.');
    }

    public function clearSession(): void
    {
        $this->session->delete('oauth_token');
        $this->session->delete('oauth_token_secret');
    }
}
