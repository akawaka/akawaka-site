<?php

declare(strict_types=1);

namespace Mono\Component\Article\Application\Operation\Write\RemoveCategory;

use Mono\Component\Article\Domain\Identifier\CategoryId;

final class Command
{
    public function __construct(
        private string $identifier,
    ) {
    }

    public function getCategoryId(): CategoryId
    {
        return new CategoryId($this->identifier);
    }
}
