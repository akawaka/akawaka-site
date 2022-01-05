<?php

declare(strict_types=1);

namespace Mono\Bundle\AkaBundle\Admin\User\Domain\Create\DataPersister\Factory;

use Mono\Bundle\AkaBundle\Admin\User\Domain\Create\DataPersister\Model\User;
use Mono\Bundle\AkaBundle\Admin\User\Domain\Create\DataPersister\Model\UserInterface;

final class Builder implements BuilderInterface
{
    public static function build(array $user = []): UserInterface
    {
        return new User(
            $user['id'],
            $user['username'],
            $user['email'],
            $user['password']
        );
    }
}
