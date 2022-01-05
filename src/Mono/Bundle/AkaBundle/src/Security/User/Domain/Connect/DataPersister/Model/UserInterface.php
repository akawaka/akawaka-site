<?php

declare(strict_types=1);

namespace Mono\Bundle\AkaBundle\Security\User\Domain\Connect\DataPersister\Model;

use Mono\Bundle\AkaBundle\Shared\Domain\ValueObject\Username;

interface UserInterface
{
    public function getUsername(): Username;
}
