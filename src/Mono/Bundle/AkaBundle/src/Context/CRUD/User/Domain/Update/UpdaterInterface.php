<?php

declare(strict_types=1);

namespace Mono\Bundle\AkaBundle\Context\CRUD\User\Domain\Update;

use Mono\Bundle\AkaBundle\Context\CRUD\User\Domain\Update\DataPersister\Model\UserInterface;

interface UpdaterInterface
{
    public function update(UserInterface $user): void;
}
