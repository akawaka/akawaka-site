<?php

declare(strict_types=1);

namespace Mono\Bundle\AkaBundle\Context\CRUD\User\Domain\Update\DataPersister;

use Mono\Bundle\AkaBundle\Context\CRUD\User\Domain\Update\DataPersister\Model\UserInterface;

interface UpdatePersisterInterface
{
    public function update(UserInterface $user): bool;
}
