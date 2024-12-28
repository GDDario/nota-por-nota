<?php

namespace Src\Domain\ValueObjects;

use Src\Domain\Exceptions\InvalidUuidException;

final class Uuid
{
    private string $value;

    /**
     * @throws InvalidUuidException
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
     * @throws InvalidUuidException
     */
    private function validate(string $value): void
    {
        if (!preg_match(
            '/^[0-9a-fA-F]{8}-[0-9a-fA-F]{4}-[0-9a-fA-F]{4}-[0-9a-fA-F]{4}-[0-9a-fA-F]{12}$/',
            $value
        )) {
            throw new InvalidUuidException();
        }
    }
}
