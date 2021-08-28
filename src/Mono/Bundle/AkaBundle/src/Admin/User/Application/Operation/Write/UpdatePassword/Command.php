<?php

declare(strict_types=1);

namespace Mono\Bundle\AkaBundle\Admin\User\Application\Operation\Write\UpdatePassword;

use Mono\Bundle\AkaBundle\Shared\Domain\Identifier\UserId;

final class Command
{
    public function __construct(
        private string $identifier,
        private string $password,
    ) {
    }

    public function getId(): UserId
    {
        return new UserId($this->identifier);
    }

    public function getPassword(): string
    {
        return $this->password;
    }
}
