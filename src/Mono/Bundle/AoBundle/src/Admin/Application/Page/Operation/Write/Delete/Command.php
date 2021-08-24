<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Application\Page\Operation\Write\Delete;

use Mono\Bundle\AoBundle\Admin\Domain\Shared\Identifier\PageId;

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
