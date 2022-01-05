<?php

declare(strict_types=1);

namespace Mono\Bundle\AkaBundle\Security\PasswordRecovery\Domain\View\DataProvider\Factory;

use Mono\Bundle\AkaBundle\Security\PasswordRecovery\Domain\View\DataProvider\Model\Recovery;
use Mono\Bundle\AkaBundle\Security\PasswordRecovery\Domain\View\DataProvider\Model\RecoveryInterface;
use Mono\Bundle\AkaBundle\Security\PasswordRecovery\Domain\View\DataProvider\Model\User;
use Mono\Bundle\AkaBundle\Shared\Domain\Model\PasswordRecoveryInterface;
use Mono\Bundle\AkaBundle\Shared\Domain\ValueObject\Username;

final class Builder implements BuilderInterface
{
    public static function build(PasswordRecoveryInterface $recovery): RecoveryInterface
    {
        return new Recovery(
            $recovery->getId(),
            $recovery->getToken(),
            new User(
                new Username($recovery->getUser()->getUsername()),
                $recovery->getUser()->getEmail(),
            ),
            $recovery->getCreationDate(),
        );
    }
}
