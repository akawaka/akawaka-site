<?php

declare(strict_types=1);

namespace App\CMS\Application\Page\Operation\Read\FindById;

use Mono\Component\Page\Domain\Identifier\PageId;

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
