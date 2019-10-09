<?php

declare(strict_types=1);

namespace App\Aggregates;

use App\Model\User as UserModel;
use Doctrine\ODM\MongoDB\DocumentManager;

class User
{
    private $documentManager;

    public function __construct(DocumentManager $documentManager)
    {
        $this->documentManager = $documentManager;
    }

    public function exists(string $userId): bool
    {
        $result = $this->find($userId);

        if (count($result) >= 1) {
            return true;
        }

        return false;
    }

    public function find(string $userId): array
    {
        return $this->documentManager->getRepository(UserModel::class)
            ->findBy(['userId' => $userId]);
    }

    public function add(array $data): bool
    {
        $user = new UserModel();
        $user->setUserId($data['user_id']);
        $user->setScreenName($data['screen_name']);
        $user->setOAuthToken($data['oauth_token']);
        $user->setOAuthTokenSecret($data['oauth_token_secret']);

        $this->documentManager->persist($user);
        $this->documentManager->flush();

        return $this->exists($data['user_id']);
    }

    public function update(array $data): void
    {
        $this->documentManager->createQueryBuilder(UserModel::class)
            ->updateOne()
            ->field('screenName')->set($data['screen_name'])
            ->field('oauthToken')->set($data['oauth_token'])
            ->field('oauthTokenSecret')->set($data['oauth_token_secret'])
            ->field('userId')->equals($data['user_id'])
            ->getQuery()
            ->execute();
    }
}
