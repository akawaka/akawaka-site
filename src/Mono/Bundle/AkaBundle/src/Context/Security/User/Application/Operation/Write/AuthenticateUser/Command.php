<?php

declare(strict_types=1);

namespace Mono\Bundle\AkaBundle\Context\Security\User\Application\Operation\Write\AuthenticateUser;

use Mono\Bundle\AkaBundle\Shared\Domain\ValueObject\Username;

final class Command
{
    public function __construct(
        private string $username
    ) {
    }

    public function getUsername(): Username
    {
        return new Username($this->username);
    }
}
