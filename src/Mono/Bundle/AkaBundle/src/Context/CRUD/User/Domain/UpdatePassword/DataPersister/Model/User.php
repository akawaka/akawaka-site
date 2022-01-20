<?php

declare(strict_types=1);

namespace Mono\Bundle\AkaBundle\Context\CRUD\User\Domain\UpdatePassword\DataPersister\Model;

use Mono\Bundle\AkaBundle\Shared\Domain\Identifier\UserId;

final class User implements UserInterface
{
    public function __construct(
        private UserId $id,
        private string $password,
    ) {
    }

    public function getId(): UserId
    {
        return $this->id;
    }

    public function getPassword(): string
    {
        return $this->password;
    }
}
