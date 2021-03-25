<?php

declare(strict_types=1);

namespace Black\Bundle\PeanutBundle\Application\Page\QueryHandler;

use Black\Bundle\PeanutBundle\Application\Page\Query\QueryFindPagesByStatus;
use Black\Bundle\PeanutBundle\Domain\Repository\FindPagesByStatusRepository;

final class HandleFindPagesByStatus
{
    private FindPagesByStatusRepository $repository;

    public function __construct(
        FindPagesByStatusRepository $repository
    ) {
        $this->repository = $repository;
    }

    public function __invoke(QueryFindPagesByStatus $query): array
    {
        return $this->repository->findPages($query->getStatus(), $query->getPage());
    }
}
