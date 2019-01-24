<?php

namespace App\Domain;

class User
{
    /** @var int */
    protected $id;

    /** @var string */
    private $dni;

    /** @var string */
    protected $name;

    /** @var string */
    private $lastName;

    public function __construct(string $dni, string $name, string $lastName)
    {
        $this->name = $name;
        $this->lastName = $lastName;
        $this->dni = $dni;
    }

    public function id(): int
    {
        return $this->id;
    }

    public function dni(): string
    {
        return $this->dni;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function lastName(): string
    {
        return $this->lastName;
    }
}
