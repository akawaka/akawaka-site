<?php

declare(strict_types=1);

namespace Mono\Component\Page\Application\Operation\Write\Publish;

use Mono\Component\Page\Domain\Identifier\PageId;

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
