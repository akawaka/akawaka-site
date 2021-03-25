<?php

declare(strict_types=1);

namespace Black\Bundle\PeanutBundle\Application\Page\QueryHandler;

use Black\Bundle\PeanutBundle\Application\Page\Query\QueryFindPages;
use Black\Bundle\PeanutBundle\Domain\Repository\FindPagesRepository;

final class HandleFindPages
{
    private FindPagesRepository $repository;

    public function __construct(
        FindPagesRepository $repository
    ) {
        $this->repository = $repository;
    }

    public function __invoke(QueryFindPages $query): array
    {
        return $this->repository->findPages($query->getPage());
    }
}
