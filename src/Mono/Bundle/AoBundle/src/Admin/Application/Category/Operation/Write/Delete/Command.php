<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Application\Category\Operation\Write\Delete;

use Mono\Bundle\AoBundle\Admin\Domain\Shared\Identifier\CategoryId;

final class Command
{
    public function __construct(
        private string $identifier,
    ) {
    }

    public function getId(): CategoryId
    {
        return new CategoryId($this->identifier);
    }
}
