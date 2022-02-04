<?php

declare(strict_types=1);

namespace Mono\Bundle\AkaBundle\Context\CRUD\User\Domain\Browse\DataProvider\Factory;

use Mono\Bundle\AkaBundle\Context\CRUD\User\Domain\Browse\DataProvider\Model\User;
use Mono\Bundle\AkaBundle\Context\CRUD\User\Domain\Browse\DataProvider\Model\UserInterface;
use Mono\Bundle\AkaBundle\Shared\Domain\ValueObject\Username;

final class Builder implements BuilderInterface
{
    public static function build(\Symfony\Component\Security\Core\User\UserInterface $user): UserInterface
    {
        return new User(
            $user->getId(),
            new Username($user->getUsername()),
            $user->getEmail(),
            $user->getPassword(),
            $user->getRegistrationDate(),
            $user->getLastUpdate(),
            $user->getLastConnection(),
        );
    }
}
