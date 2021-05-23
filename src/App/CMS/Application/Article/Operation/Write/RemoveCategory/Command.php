<?php

declare(strict_types=1);

namespace App\CMS\Application\Article\Operation\Write\RemoveCategory;

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
