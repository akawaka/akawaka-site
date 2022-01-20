<?php

declare(strict_types=1);

namespace Mono\Bundle\AkaBundle\Context\Security\User\Domain\Connect\DataPersister\Factory;

use Mono\Bundle\AkaBundle\Context\Security\User\Domain\Connect\DataPersister\Model\UserInterface;

interface BuilderInterface
{
    public static function build(array $user = []): UserInterface;
}
