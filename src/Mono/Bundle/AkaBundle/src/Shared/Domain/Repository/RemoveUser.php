<?php

declare(strict_types=1);

namespace Mono\Bundle\AkaBundle\Shared\Domain\Repository;

use Mono\Bundle\AkaBundle\Shared\Domain\Entity\UserInterface;

interface RemoveUser
{
    public function remove(UserInterface $user): void;
}
