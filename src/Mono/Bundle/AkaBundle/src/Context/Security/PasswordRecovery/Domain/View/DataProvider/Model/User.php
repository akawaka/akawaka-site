<?php

declare(strict_types=1);

namespace Mono\Bundle\AkaBundle\Context\Security\PasswordRecovery\Domain\View\DataProvider\Model;

use Mono\Bundle\AkaBundle\Shared\Domain\ValueObject\Username;
use Mono\Primitive\EmailAddress\EmailAddress;

final class User implements UserInterface
{
    public function __construct(
        private Username $username,
        private EmailAddress $email,
    ) {
    }

    public function getUsername(): Username
    {
        return $this->username;
    }

    public function getEmail(): EmailAddress
    {
        return $this->email;
    }
}
