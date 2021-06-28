<?php

declare(strict_types=1);

namespace Mono\Component\Article\Application\Operation\Category\Read\FindById;

use Mono\Component\Article\Domain\Common\Identifier\CategoryId;

final class Query
{
    public function __construct(
        private string $id
    ) {
    }

    public function getId(): CategoryId
    {
        return new CategoryId($this->id);
    }
}
