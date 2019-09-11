<?php

namespace App\TwitterMapper\Object;

use Carbon\Carbon;

class Tweet
{
    private $id;

    private $text;

    private $createdAt;

    private $retweetCount;

    private $favouriteCount;

    private $retweeted;

    private $favourited;

    private $language;

    public function __construct(
        int $id,
        string $text,
        string $createdAt,
        int $retweetCount,
        int $favouriteCount,
        bool $retweeted,
        bool $favourited,
        string $language
    ) {
        $this->id = $id;

        $this->text = $text;

        $this->createdAt = $createdAt;

        $this->retweetCount = $retweetCount;

        $this->favouriteCount = $favouriteCount;

        $this->retweeted = $retweeted;

        $this->favourited = $favourited;

        $this->language = $language;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getText(): string
    {
        return $this->text;
    }

    public function getCreatedAt(): Carbon
    {
        return Carbon::parse($this->createdAt);
    }

    public function getRetweetCount(): int
    {
        return $this->retweetCount;
    }

    public function getFavouriteCount(): int
    {
        return $this->favouriteCount;
    }

    public function getRetweeted(): bool
    {
        return $this->retweeted;
    }

    public function getFavourited(): bool
    {
        return $this->favourited;
    }

    public function getLanguage(): string
    {
        return $this->language;
    }

    public function getTweetAge(): int
    {
        return ceil(((Carbon::now()->getTimestamp() - $this->getCreatedAt()->getTimestamp()) / 3600) / 24);
    }
}
