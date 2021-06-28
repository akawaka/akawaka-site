<?php

declare(strict_types=1);

namespace App\CMS\Application\Page\Operation\Write\Publish;

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
