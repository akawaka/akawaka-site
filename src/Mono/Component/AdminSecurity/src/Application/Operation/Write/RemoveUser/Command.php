<?php

declare(strict_types=1);

namespace Mono\Component\AdminSecurity\Application\Operation\Write\RemoveUser;

use Mono\Component\AdminSecurity\Domain\Identifier\UserId;

final class Command
{
    public function __construct(
        private string $identifier
    ) {
    }

    public function getId(): UserId
    {
        return new UserId($this->identifier);
    }
}
