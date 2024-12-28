<?php

namespace Src\Domain\Entities;

use DateTime;
use Src\Domain\Exceptions\DomainException;
use Src\Domain\ValueObjects\Email;
use Src\Domain\ValueObjects\Uuid;

final class User
{
    /**
     * @throws DomainException
     */
    public function __construct(
        public int       $id,
        public Uuid      $uuid,
        public string    $name,
        public Email     $email,
        public string    $username,
        public DateTime  $createdAt,
        public ?DateTime $updatedAt = null,
        public ?DateTime $deleteAt = null,
    )
    {
        $this->validate();
    }

    /**
     * @throws DomainException
     */
    private function validate(): void
    {
        if (empty($this->id)) {
            throw new DomainException('User ID cannot be empty.');
        }

        if (empty($this->name)) {
            throw new DomainException('User name cannot be empty.');
        }

        if (empty($this->username)) {
            throw new DomainException('The username is required.');
        }

        if ($this->createdAt > new DateTime()) {
            throw new DomainException('The createdAt date cannot be in the future.');
        }

        if ($this->updatedAt !== null && $this->updatedAt < $this->createdAt) {
            throw new DomainException('The updatedAt date cannot be earlier than createdAt.');
        }

        if ($this->deleteAt !== null && $this->deleteAt < $this->createdAt) {
            throw new DomainException('The deleteAt date cannot be earlier than createdAt.');
        }
    }
}
