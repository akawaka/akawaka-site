<?php

declare(strict_types=1);

namespace Mono\Bundle\AkaBundle\Context\CRUD\User\Domain\UpdatePassword;

use Mono\Bundle\AkaBundle\Context\CRUD\User\Domain\UpdatePassword\DataPersister\Model\UserInterface;

interface UpdaterInterface
{
    public function update(UserInterface $user): void;
}
