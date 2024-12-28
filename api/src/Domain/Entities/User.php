<?php

namespace Src\Domain\Entities;

use DateTime;
use Src\Domain\ValueObjects\Email;

final class User
{
    public int $id;
    public string $uuid;
    public string $name;
    public Email $email;
    public string $username;
    public DateTime $createdAt;
    public ?DateTime $updatedAt = null;
    public ?DateTime $deleteAt = null;
}
