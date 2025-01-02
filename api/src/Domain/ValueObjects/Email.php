<?php

namespace Src\Domain\ValueObjects;

use Src\Domain\Exceptions\InvalidEmailException;

final class Email
{
    private string $value;

    /**
     * @throws InvalidEmailException
     */
    public function __construct(string $value)
    {
        $this->validate($value);
        $this->value = $value;
    }

    public function __toString(): string
    {
        return $this->value;
    }

    /**
     * @throws InvalidEmailException
     */
    private function validate(string $value): void
    {
        if (! filter_var($value, FILTER_VALIDATE_EMAIL)) {
            throw new InvalidEmailException;
        }
    }
}
