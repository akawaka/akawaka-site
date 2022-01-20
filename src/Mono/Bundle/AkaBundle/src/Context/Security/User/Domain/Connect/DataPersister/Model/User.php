<?php

declare(strict_types=1);

namespace Mono\Bundle\AkaBundle\Context\Security\User\Domain\Connect\DataPersister\Model;

use Mono\Bundle\AkaBundle\Shared\Domain\ValueObject\Username;

final class User implements UserInterface
{
    public function __construct(
        private Username $username,
    ) {
    }

    public function getUsername(): Username
    {
        return $this->username;
    }
}
