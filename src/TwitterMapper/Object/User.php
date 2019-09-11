<?php

namespace App\TwitterMapper\Object;

use Carbon\Carbon;

class User
{
    private $twitterId;

    private $handle;

    private $location;

    private $timeZone;

    private $description;

    private $websiteUrlString;

    private $privateAccount;

    private $followersCount;

    private $followsCount;

    private $listedCount;

    private $createdAt;

    private $favouritesCount;

    private $tweetsCount;

    private $language;

    private $avatarUrlString;

    private $isFollowing;

    private $lastTweet;

    public function __construct(
        int $twitterId,
        string $handle,
        string $location,
        string $timeZone,
        string $description,
        string $websiteUrlString,
        string $privateAccount,
        int $followersCount,
        int $followsCount,
        int $listedCount,
        string $createdAt,
        int $favouritesCount,
        int $tweetsCount,
        string $language,
        string $avatarUrlString,
        bool $isFollowing
    ) {
        $this->twitterId = $twitterId;

        $this->handle = $handle;

        $this->location = $location;

        $this->timeZone = $timeZone;

        $this->description = $description;

        $this->websiteUrlString = $websiteUrlString;

        $this->privateAccount = $privateAccount;

        $this->followersCount = $followersCount;

        $this->followsCount = $followsCount;

        $this->listedCount = $listedCount;

        $this->createdAt = $createdAt;

        $this->favouritesCount = $favouritesCount;

        $this->tweetsCount = $tweetsCount;

        $this->language = $language;

        $this->avatarUrlString = $avatarUrlString;

        $this->isFollowing = $isFollowing;
    }

    public function getTwitterId(): int
    {
        return $this->twitterId;
    }

    public function getHandle(): string
    {
        return $this->handle;
    }

    public function getLocation(): string
    {
        return $this->location;
    }

    public function getTimeZone(): string
    {
        return $this->timeZone;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getWebsiteUrlString(): string
    {
        return $this->websiteUrlString;
    }

    public function getPrivateAccount(): bool
    {
        return $this->privateAccount;
    }

    public function getFollowersCount(): int
    {
        return $this->followersCount;
    }

    public function getFollowsCount(): int
    {
        return $this->followsCount;
    }

    public function getListedCount(): int
    {
        return $this->listedCount;
    }

    public function getCreatedAt(): Carbon
    {
        return Carbon::parse($this->createdAt);
    }

    public function getAccountAgeDays(): int
    {
        return $this->calculateAccountAgeDays(
            Carbon::parse($this->createdAt)->getTimestamp(),
            Carbon::now()->getTimestamp()
        );
    }

    public function getFavouritesCount(): int
    {
        return $this->favouritesCount;
    }

    public function getTweetsCount(): int
    {
        return $this->tweetsCount;
    }

    public function getTweetsPerDayCount(): float
    {
        return $this->calculateTweetsPerDay($this->getAccountAgeDays(), $this->tweetsCount);
    }

    public function getLanguage(): string
    {
        return $this->language;
    }

    public function getAvatarUrlString(): string
    {
        return $this->avatarUrlString;
    }

    public function getIsFollowing(): bool
    {
        return $this->isFollowing;
    }

    public function setLastTweet(Tweet $tweet): void
    {
        $this->lastTweet = $tweet;
    }

    public function getLastTweet(): Tweet
    {
        return $this->lastTweet;
    }

    public function getFollowerFollowsRatio(): float
    {
        if ($this->followsCount !== 0) {
            return round(($this->followersCount / $this->followsCount) * 100, 1);
        }

        return 0.0;
    }

    private function calculateTweetsPerDay(int $accountAge, int $tweetsCount): float
    {
        return round($tweetsCount / $accountAge, 1);
    }

    private function calculateAccountAgeDays(int $timeStampPrevious, int $timeStampNow): int
    {
        return ceil((($timeStampNow - $timeStampPrevious) / 3600) / 24);
    }
}
