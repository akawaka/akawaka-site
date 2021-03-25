<?php

declare(strict_types=1);

namespace Black\Bundle\PeanutBundle\Application\Page\Query;

final class QueryFindPagesByStatus
{
    private string $status;

    private int $page;

    public function __construct(
        string $status,
        int $page = 1
    ) {
        $this->status = $status;
        $this->page = $page;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function getPage(): int
    {
        return $this->page;
    }
}
