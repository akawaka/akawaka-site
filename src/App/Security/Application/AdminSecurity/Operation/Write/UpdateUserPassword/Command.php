<?php

declare(strict_types=1);

namespace App\Security\Application\AdminSecurity\Operation\Write\UpdateUserPassword;

use Mono\Component\AdminSecurity\Domain\Identifier\UserId;

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
