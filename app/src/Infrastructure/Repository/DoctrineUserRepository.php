<?php

namespace App\Infrastructure\Repository;

use Doctrine\ORM\EntityRepository;
use App\Domain\User;
use App\Domain\UserRepository;

class DoctrineUserRepository extends EntityRepository implements UserRepository
{
    public function findById(int $id): User
    {
        return $this->find($id);
    }

    public function findByDni(string $dni): User
    {
        return $this->findOneBy(['dni' => $dni]);
    }

    public function getAll(): array
    {
        return $this->getEntityManager()
            ->createQuery('SELECT u FROM App\Domain\User u ORDER BY u.name')
            ->getResult();
    }
}
