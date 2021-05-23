<?php

declare(strict_types=1);

namespace App\CMS\Application\Article\Operation\Read\FindCategoryById;

use Mono\Component\Article\Domain\Identifier\CategoryId;

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
