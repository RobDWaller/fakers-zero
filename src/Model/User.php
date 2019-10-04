<?php

declare(strict_types=1);

namespace App\Model;

use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;

/** @ODM\Document */
class User
{
    /** @ODM\Id */
    private $id;

    /** @ODM\Field(type="int") */
    private $userId;

    /** @ODM\Field(type="string") */
    private $screenName;

    /** @ODM\Field(type="string") */
    private $oauthToken;

    /** @ODM\Field(type="string") */
    private $oauthTokenSecret;

    public function getId(): int
    {
        return $this->id;
    }

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function setUserId(int $userId): void
    {
        $this->userId = $userId;
    }

    public function getScreenName(): string
    {
        return $this->screenName;
    }

    public function setScreenName(string $screenName): void
    {
        $this->screenName = $screenName;
    }

    public function getOAuthToken(): string
    {
        return $this->oauthToken;
    }

    public function setOAuthToken(string $oauthToken): void
    {
        $this->oauthToken = $oauthToken;
    }

    public function getOAuthTokenSecret(): string
    {
        return $this->oauthTokenSecret;
    }

    public function setOAuthTokenSecret(string $oauthTokenSecret): void
    {
        $this->oauthTokenSecret = $oauthTokenSecret;
    }
}