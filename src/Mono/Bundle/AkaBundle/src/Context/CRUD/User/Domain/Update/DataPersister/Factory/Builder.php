<?php

declare(strict_types=1);

namespace Mono\Bundle\AkaBundle\Context\CRUD\User\Domain\Update\DataPersister\Factory;

use Mono\Bundle\AkaBundle\Context\CRUD\User\Domain\Update\DataPersister\Model\User;
use Mono\Bundle\AkaBundle\Context\CRUD\User\Domain\Update\DataPersister\Model\UserInterface;

final class Builder implements BuilderInterface
{
    public static function build(array $user = []): UserInterface
    {
        return new User(
            $user['id'],
            $user['username'],
            $user['email'],
        );
    }
}
