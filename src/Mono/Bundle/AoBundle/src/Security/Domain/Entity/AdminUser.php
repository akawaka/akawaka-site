<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Security\Domain\Entity;

use Mono\Component\AdminSecurity\Domain\Entity\User as BaseUser;
use Mono\Component\AdminSecurity\Domain\Identifier\UserId;
use Mono\Component\AdminSecurity\Domain\ValueObject\Username;
use Mono\Primitive\EmailAddress\EmailAddress;
use Symfony\Component\Security\Core\User\UserInterface;

class AdminUser extends BaseUser implements UserInterface
{
    public static function create(
        UserId $id,
        Username $username,
        EmailAddress $emailAddress,
    ): self {
        $user = new self();
        $user->id = $id->getValue();
        $user->username = $username->getValue();
        $user->email = $emailAddress->getValue();

        return $user;
    }

    public function getRoles(): array
    {
        return [
            'ROLE_ADMIN',
        ];
    }

    public function getSalt(): void
    {
    }

    public function eraseCredentials(): void
    {
    }
}
