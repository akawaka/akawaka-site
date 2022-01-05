<?php

declare(strict_types=1);

namespace Mono\Bundle\AkaBundle\Admin\User\Domain\Update\DataPersister\Model;

use Mono\Bundle\AkaBundle\Shared\Domain\Identifier\UserId;
use Mono\Bundle\AkaBundle\Shared\Domain\ValueObject\Username;
use Mono\Primitive\EmailAddress\EmailAddress;

final class User implements UserInterface
{
    public function __construct(
        private UserId $id,
        private Username $username,
        private EmailAddress $email,
    ) {
    }

    public function getId(): UserId
    {
        return $this->id;
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
