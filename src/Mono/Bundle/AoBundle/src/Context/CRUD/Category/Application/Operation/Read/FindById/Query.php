<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Context\CRUD\Category\Application\Operation\Read\FindById;

use Mono\Bundle\AoBundle\Shared\Domain\Identifier\CategoryId;

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
