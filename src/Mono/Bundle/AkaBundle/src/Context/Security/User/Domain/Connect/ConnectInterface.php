<?php

declare(strict_types=1);

namespace Mono\Bundle\AkaBundle\Context\Security\User\Domain\Connect;

use Mono\Bundle\AkaBundle\Context\Security\User\Domain\Connect\DataPersister\Model\UserInterface;

interface ConnectInterface
{
    public function __invoke(UserInterface $user): void;
}
