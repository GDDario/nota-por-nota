<?php

namespace Src\Domain\ValueObjects;

use Src\Domain\Exceptions\InvalidEmailException;

final class Email
{
    private string $value;

    /**
     * @throws InvalidEmailException
     */
    public function __construct($value)
    {
        $this->validate();
        $this->value = $value;
    }

    public function __toString(): string
    {
        return $this->value;
    }

    /**
     * @throws InvalidEmailException
     */
    private function validate(): void
    {
        if (!filter_var($this->value, FILTER_VALIDATE_EMAIL)) {
            throw new InvalidEmailException();
        }
    }
}
