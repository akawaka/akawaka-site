<?php

declare(strict_types=1);

namespace Mono\Bundle\AkaBundle\Admin\User\Domain\Create\DataPersister\Model;

use Mono\Bundle\AkaBundle\Shared\Domain\Identifier\UserId;
use Mono\Bundle\AkaBundle\Shared\Domain\ValueObject\Username;
use Mono\Primitive\EmailAddress\EmailAddress;

interface UserInterface
{
    public function getId(): UserId;

    public function getUsername(): Username;

    public function getEmailAddress(): EmailAddress;

    public function getPassword(): string;
}
