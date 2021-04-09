<?php

declare(strict_types=1);

namespace App\Security\Domain\Entity;

use Mono\Component\AdminSecurity\Domain\Entity\User;
use Mono\Component\AdminSecurity\Domain\Entity\User as BaseUser;
use Mono\Component\AdminSecurity\Domain\Identifier\UserId;
use Mono\Component\AdminSecurity\Domain\ValueObject\Username;
use Mono\Primitive\EmailAddress\EmailAddress;

final class AdminUser extends BaseUser
{
    public static function create(
        UserId $id,
        Username $username,
        EmailAddress $emailAddress,
    ): User {
        $user = new self();
        $user->id = $id->getValue();
        $user->username = $username->getValue();
        $user->email = $emailAddress->getValue();

        return $user;
    }
}
