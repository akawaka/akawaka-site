<?php

declare(strict_types=1);

namespace Mono\Component\Article\Application\Operation\Category\Write\Delete;

use Mono\Component\Article\Domain\Common\Identifier\CategoryId;

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
