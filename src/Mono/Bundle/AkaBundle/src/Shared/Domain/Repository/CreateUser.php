<?php

declare(strict_types=1);

namespace Mono\Bundle\AkaBundle\Shared\Domain\Repository;

use Mono\Bundle\AkaBundle\Shared\Domain\Entity\UserInterface;
use Mono\Bundle\AkaBundle\Shared\Domain\Identifier\UserId;

interface CreateUser
{
    public function insert(UserInterface $user): void;

    public function nextIdentity(): UserId;
}
