<?php

namespace Tests\Integration\Infrastructure\Repository;

use App\Domain\User;
use App\Domain\UserRepository;
use Doctrine\ORM\EntityRepository;
use Tests\Integration\Infrastructure\DatabaseTestCase;

class DoctrineUserRepositoryTest extends DatabaseTestCase
{
    public function test_it_should_return_user_by_id()
    {
        $dni      = $this->faker->dni;
        $name     = $this->faker->name;
        $lastName = $this->faker->lastName;

        $user = new User($dni, $name, $lastName);
        $this->saveUsers([$user]);

        /** @var User $userFound */
        $userFound = $this->getRepository()->findById($user->id());

        self::assertEquals($dni, $userFound->dni());
        self::assertEquals($name, $userFound->name());
        self::assertEquals($lastName, $userFound->lastName());
    }

    /** @return EntityRepository|UserRepository */
    protected function getRepository(): EntityRepository
    {
        return $this->em->getRepository(User::class);
    }

    protected function saveUsers(array $users)
    {
        foreach ($users as $user) {
            $this->em->persist($user);
        }

        $this->em->flush();
    }
}