<?php

declare(strict_types=1);

namespace Mono\Bundle\AkaBundle\Admin\User\Application\Operation\Write\Delete;

use Mono\Bundle\AkaBundle\Shared\Domain\Identifier\UserId;

final class Command
{
    public function __construct(
        private string $identifier
    ) {
    }

    public function getId(): UserId
    {
        return new UserId($this->identifier);
    }
}
