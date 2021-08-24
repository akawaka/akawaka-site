<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\Admin\Application\Page\Operation\Read\FindById;

use Mono\Bundle\AoBundle\Admin\Domain\Shared\Identifier\PageId;

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
