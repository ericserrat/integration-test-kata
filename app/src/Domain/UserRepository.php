<?php

namespace App\Domain;

interface UserRepository
{
    public function findById(int $id): User;

    public function findByDni(string $dni): User;

    /** @return User[] */
    public function getAll(): array;
}
