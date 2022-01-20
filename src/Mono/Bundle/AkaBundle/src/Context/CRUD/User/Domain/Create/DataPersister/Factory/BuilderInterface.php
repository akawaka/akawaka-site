<?php

declare(strict_types=1);

namespace Mono\Bundle\AkaBundle\Context\CRUD\User\Domain\Create\DataPersister\Factory;

use Mono\Bundle\AkaBundle\Context\CRUD\User\Domain\Create\DataPersister\Model\UserInterface;

interface BuilderInterface
{
    public static function build(array $user = []): UserInterface;
}
