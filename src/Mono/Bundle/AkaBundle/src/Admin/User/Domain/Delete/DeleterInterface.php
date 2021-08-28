<?php

declare(strict_types=1);

namespace Mono\Bundle\AkaBundle\Admin\User\Domain\Delete;

use Mono\Bundle\AkaBundle\Shared\Domain\Identifier\UserId;

interface DeleterInterface
{
    public function delete(UserId $id): void;
}
