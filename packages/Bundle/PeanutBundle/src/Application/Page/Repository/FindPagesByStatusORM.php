<?php

declare(strict_types=1);

namespace Black\Bundle\PeanutBundle\Application\Page\Repository;

use Black\Bundle\PeanutBundle\Domain\Entity\Page\Page;
use Black\Bundle\PeanutBundle\Domain\Repository\FindPagesByStatusRepository;
use Black\Bundle\CoreBundle\Infrastructure\Persistence\Doctrine\DoctrineRepository;
use Black\Component\Page\Enum\StatusEnum;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\Query\Parameter;
use Doctrine\ORM\Tools\Pagination\Paginator;

final class FindPagesByStatusORM extends DoctrineRepository implements FindPagesByStatusRepository
{
    private const ITEMS_PER_PAGE = 10;

    public function __construct(ManagerRegistry $managerRegistry)
    {
        parent::__construct($managerRegistry, Page::class);
    }

    public function findPages(string $status = StatusEnum::PUBLISHED, int $page = 1): array
    {
        $firstResult = ($page - 1) * self::ITEMS_PER_PAGE;

        $query = $this->getQuery(<<<DQL
                SELECT page
                FROM {$this->getClassName()} page
                WHERE page.status = :status
                ORDER BY page.dateUpdated DESC, page.dateCreated DESC
        DQL);

        $query
            ->setParameters(new ArrayCollection([
                new Parameter('status', $status),
            ]))
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
