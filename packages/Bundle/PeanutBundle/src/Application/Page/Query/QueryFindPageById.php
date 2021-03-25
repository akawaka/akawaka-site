<?php

declare(strict_types=1);

namespace Black\Bundle\PeanutBundle\Application\Page\Query;

use Black\Bundle\PeanutBundle\Domain\Identifier\PageId;

final class QueryFindPageById
{
    private string $id;

    public function __construct(
        string $id
    ) {
        $this->id = $id;
    }

    public function getId(): PageId
    {
        return new PageId($this->id);
    }
}
