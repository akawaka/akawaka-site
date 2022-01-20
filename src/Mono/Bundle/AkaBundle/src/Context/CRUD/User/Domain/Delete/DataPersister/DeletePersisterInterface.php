<?php

declare(strict_types=1);

namespace Mono\Bundle\AkaBundle\Context\CRUD\User\Domain\Delete\DataPersister;

use Mono\Bundle\AkaBundle\Shared\Domain\Identifier\UserId;

interface DeletePersisterInterface
{
    public function delete(UserId $id): bool;
}
