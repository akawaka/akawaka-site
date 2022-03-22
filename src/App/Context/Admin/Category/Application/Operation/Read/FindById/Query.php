<?php

declare(strict_types=1);

namespace App\Context\Admin\Category\Application\Operation\Read\FindById;

use App\Shared\Domain\Identifier\CategoryId;

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
