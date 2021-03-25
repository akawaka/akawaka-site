<?php

declare(strict_types=1);

namespace Black\Bundle\PeanutBundle\Application\Page\Query;

final class QueryFindPages
{
    private int $page;

    public function __construct(
        int $page = 1
    ) {
        $this->page = $page;
    }

    public function getPage(): int
    {
        return $this->page;
    }
}
