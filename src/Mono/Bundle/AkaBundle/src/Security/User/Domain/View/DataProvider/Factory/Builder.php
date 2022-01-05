<?php

declare(strict_types=1);

namespace Mono\Bundle\AkaBundle\Security\User\Domain\View\DataProvider\Factory;

use Mono\Bundle\AkaBundle\Security\User\Domain\View\DataProvider\Model\User;
use Mono\Bundle\AkaBundle\Security\User\Domain\View\DataProvider\Model\UserInterface;
use Mono\Bundle\AkaBundle\Shared\Domain\ValueObject\Username;

final class Builder implements BuilderInterface
{
    public static function build(\Mono\Bundle\AkaBundle\Shared\Domain\Model\UserInterface $user): UserInterface
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
