<?php

declare(strict_types=1);

namespace Mono\Bundle\AkaBundle\Context\CRUD\User\Domain\UpdatePassword\DataPersister\Factory;

use Mono\Bundle\AkaBundle\Context\CRUD\User\Domain\UpdatePassword\DataPersister\Model\UserInterface;

interface BuilderInterface
{
    public static function build(array $user = []): UserInterface;
}
