<?php

declare(strict_types=1);

namespace Mono\Bundle\AkaBundle\Admin\User\Domain\UpdatePassword\DataPersister;

use Mono\Bundle\AkaBundle\Admin\User\Domain\UpdatePassword\DataPersister\Model\UserInterface;

interface UpdatePasswordPersisterInterface
{
    public function update(UserInterface $user): bool;
}
