<?php

declare(strict_types=1);

namespace Mono\Bundle\AkaBundle\Admin\User\Domain\Create\Factory;

use Mono\Bundle\AkaBundle\Admin\User\Domain\Create\Model\User;
use Mono\Bundle\AkaBundle\Admin\User\Domain\Create\Model\UserInterface;

final class Builder implements BuilderInterface
{
    public static function build(array $user = []): UserInterface
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
