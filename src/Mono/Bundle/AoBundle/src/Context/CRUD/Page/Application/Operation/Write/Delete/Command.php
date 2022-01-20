<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Context\CRUD\Page\Application\Operation\Write\Delete;

use Mono\Bundle\AoBundle\Shared\Domain\Identifier\PageId;

final class Command
{
    public function __construct(
        private string $identifier,
    ) {
    }

    public function getId(): PageId
    {
        return new PageId($this->identifier);
    }
}
