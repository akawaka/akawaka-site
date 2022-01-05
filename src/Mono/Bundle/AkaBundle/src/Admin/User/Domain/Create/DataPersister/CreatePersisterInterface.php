<?php

declare(strict_types=1);

namespace Mono\Bundle\AkaBundle\Admin\User\Domain\Create\DataPersister;

use Mono\Bundle\AkaBundle\Admin\User\Domain\Create\DataPersister\Model\UserInterface;

interface CreatePersisterInterface
{
    public function create(UserInterface $user): bool;
}
