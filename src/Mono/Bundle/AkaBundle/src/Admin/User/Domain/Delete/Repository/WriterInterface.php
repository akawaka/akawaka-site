<?php

declare(strict_types=1);

namespace Mono\Bundle\AkaBundle\Admin\User\Domain\Delete\Repository;

use Mono\Bundle\AkaBundle\Shared\Domain\Identifier\UserId;

interface WriterInterface
{
    public function delete(UserId $id): bool;
}
