<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Context\CRUD\Page\Application\Operation\Read\FindById;

use Mono\Bundle\AoBundle\Shared\Domain\Identifier\PageId;

final class Query
{
    public function __construct(
        private string $id
    ) {
    }

    public function getId(): PageId
    {
        return new PageId($this->id);
    }
}
