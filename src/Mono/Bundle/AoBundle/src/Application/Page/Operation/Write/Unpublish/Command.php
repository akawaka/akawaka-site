<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Application\Page\Operation\Write\Unpublish;

use Mono\Component\Page\Domain\Common\Identifier\PageId;

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
