<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Category\Application\Operation\Write\Delete;

use Mono\Bundle\AoBundle\Shared\Domain\Identifier\CategoryId;

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
