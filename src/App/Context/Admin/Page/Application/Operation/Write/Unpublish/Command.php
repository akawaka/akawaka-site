<?php

declare(strict_types=1);

namespace App\Context\Admin\Page\Application\Operation\Write\Unpublish;

use App\Shared\Domain\Identifier\PageId;

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
