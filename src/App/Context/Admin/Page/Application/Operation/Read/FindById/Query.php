<?php

declare(strict_types=1);

namespace App\Context\Admin\Page\Application\Operation\Read\FindById;

use App\Shared\Domain\Identifier\PageId;

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
