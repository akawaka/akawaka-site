<?php

declare(strict_types=1);

namespace Mono\Bundle\AkaBundle\Admin\User\Domain\Update\Factory;

use Mono\Bundle\AkaBundle\Admin\User\Domain\Update\Model\User;
use Mono\Bundle\AkaBundle\Admin\User\Domain\Update\Model\UserInterface;

final class Builder implements BuilderInterface
{
    public static function build(array $User = []): UserInterface
    {
        return new User(
            $user['id'],
            $user['username'],
            $user['password'],
            $user['email'],
            $user['registrationDate'],
        );
    }
}
