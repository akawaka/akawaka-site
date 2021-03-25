<?php

declare(strict_types=1);

namespace Black\Bundle\PeanutBundle\Application\Page\Repository;

use Black\Bundle\PeanutBundle\Domain\Entity\Page\Page;
use Black\Bundle\PeanutBundle\Domain\Repository\FindPagesRepository;
use Black\Bundle\CoreBundle\Infrastructure\Persistence\Doctrine\DoctrineRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\Tools\Pagination\Paginator;

final class FindPagesORM extends DoctrineRepository implements FindPagesRepository
{
    private const ITEMS_PER_PAGE = 10;

    public function __construct(ManagerRegistry $managerRegistry)
    {
        parent::__construct($managerRegistry, Page::class);
    }

    public function findPages(int $page = 1): array
    {
        $firstResult = ($page - 1) * self::ITEMS_PER_PAGE;

        $query = $this->getQuery(<<<DQL
                SELECT page
                FROM {$this->getClassName()} page
                ORDER BY page.dateUpdated DESC, page.dateCreated DESC
        DQL);

        $query
            ->setFirstResult($firstResult)
            ->setMaxResults(self::ITEMS_PER_PAGE);
        $paginator = new Paginator($query);
        $paginator->setUseOutputWalkers(false);

        return [
            'totalItems' => $paginator->count(),
            'currentPage' => $page,
            'maxPages' => (int) floor($paginator->count() / self::ITEMS_PER_PAGE),
            'results' => $paginator->getQuery()->execute(),
        ];
    }
}
