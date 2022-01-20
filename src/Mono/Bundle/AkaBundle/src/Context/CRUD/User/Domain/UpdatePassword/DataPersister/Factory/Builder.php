<?php

declare(strict_types=1);

namespace Mono\Bundle\AkaBundle\Context\CRUD\User\Domain\UpdatePassword\DataPersister\Factory;

use Mono\Bundle\AkaBundle\Context\CRUD\User\Domain\UpdatePassword\DataPersister\Model\User;
use Mono\Bundle\AkaBundle\Context\CRUD\User\Domain\UpdatePassword\DataPersister\Model\UserInterface;

final class Builder implements BuilderInterface
{
    public static function build(array $user = []): UserInterface
    {
        return new User(
            $user['id'],
            $user['password'],
        );
    }
}
