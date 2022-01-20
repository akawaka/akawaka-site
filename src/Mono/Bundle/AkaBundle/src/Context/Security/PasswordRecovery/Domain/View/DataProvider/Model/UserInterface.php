<?php

declare(strict_types=1);

namespace Mono\Bundle\AkaBundle\Context\Security\PasswordRecovery\Domain\View\DataProvider\Model;

use Mono\Bundle\AkaBundle\Shared\Domain\ValueObject\Username;
use Mono\Primitive\EmailAddress\EmailAddress;

interface UserInterface
{
    public function getUsername(): Username;

    public function getEmail(): EmailAddress;
}
