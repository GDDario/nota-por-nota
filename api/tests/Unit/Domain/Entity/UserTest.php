<?php

namespace Tests\Unit\Domain\Entity;

use DateInterval;
use DateTime;
use Src\Domain\Entities\User;
use Src\Domain\Exceptions\{DomainException, InvalidEmailException, InvalidUuidException};
use Src\Domain\ValueObjects\{Email, Uuid};

describe('User', function () {
    test('it can be created with valid attributes', function () {
        $user = new User(
            1,
            new Uuid('4927b419-2316-4fec-aae0-55be237fb814'),
            'John Doe',
            new Email('john@doe.com'),
            'johndoe456',
            new DateTime()
        );

        expect($user)->toBeInstanceOf(User::class);
    });

    test('it throws InvalidUuidException when UUID is invalid', function () {
        new User(
            1,
            new Uuid('Invalid uuid'),
            'John Doe',
            new Email('john@doe.com'),
            'johndoe456',
            new DateTime()
        );
    })->throws(InvalidUuidException::class, 'Invalid Uuid format.');

    test('it throws DomainException when name is empty', function () {
        new User(
            1,
            new Uuid('4927b419-2316-4fec-aae0-55be237fb814'),
            '',
            new Email('john@doe.com'),
            'johndoe456',
            new DateTime()
        );
    })->throws(DomainException::class, 'User name cannot be empty.');

    test('it throws InvalidEmailException when email is invalid', function () {
        new User(
            1,
            new Uuid('4927b419-2316-4fec-aae0-55be237fb814'),
            'John Doe',
            new Email('Invalid email'),
            'johndoe456',
            new DateTime()
        );
    })->throws(InvalidEmailException::class, 'Invalid email provided.');

    test('it throws DomainException when username is empty', function () {
        new User(
            1,
            new Uuid('4927b419-2316-4fec-aae0-55be237fb814'),
            'John Doe',
            new Email('john@doe.com'),
            '',
            new DateTime()
        );
    })->throws(DomainException::class, 'The username is required.');

    test('it throws DomainException when updatedAt is earlier than createdAt', function () {
        $createdAt = new DateTime();
        $updatedAt = (clone $createdAt)->sub(new DateInterval('P1D'));

        new User(
            1,
            new Uuid('4927b419-2316-4fec-aae0-55be237fb814'),
            'John Doe',
            new Email('john@doe.com'),
            'johndoe456',
            $createdAt,
            null,
            null,
            $updatedAt
        );
    })->throws(DomainException::class, 'The updatedAt date cannot be earlier than createdAt.');

    test('it throws DomainException when deleteAt is earlier than createdAt', function () {
        $createdAt = new DateTime();
        $deleteAt  = (clone $createdAt)->sub(new DateInterval('P1D'));

        new User(
            1,
            new Uuid('4927b419-2316-4fec-aae0-55be237fb814'),
            'John Doe',
            new Email('john@doe.com'),
            'johndoe456',
            $createdAt,
            null,
            null,
            null,
            $deleteAt
        );
    })->throws(DomainException::class, 'The deleteAt date cannot be earlier than createdAt.');
});
