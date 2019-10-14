<?php

declare(strict_types=1);

namespace App\Aggregates;

use App\Model\User as UserModel;
use SlimSession\Helper as Session;
use Doctrine\ODM\MongoDB\DocumentManager;

class User
{
    private $documentManager;

    private $session;

    public function __construct(DocumentManager $documentManager, Session $session)
    {
        $this->documentManager = $documentManager;

        $this->session = $session;
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

    public function login(): void
    {
        $this->session->set('login', 1);
    }

    public function logout(): void
    {
        $this->session->delete('login');
    }

    public function checkSession(): bool
    {
        return $this->session->get('login') === 1;
    }
}
