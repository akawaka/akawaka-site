<?php

declare(strict_types=1);

namespace Black\Bundle\PeanutBundle\Application\Page\Repository;

use Black\Bundle\PeanutBundle\Domain\Entity\Page\Page;
use Black\Bundle\PeanutBundle\Domain\Identifier\PageId;
use Black\Bundle\PeanutBundle\Domain\Repository\FindPageByIdRepository;
use Black\Bundle\CoreBundle\Infrastructure\Persistence\Doctrine\DoctrineRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\Query\Parameter;

final class FindPageByIdORM extends DoctrineRepository implements FindPageByIdRepository
{
    public function __construct(ManagerRegistry $managerRegistry)
    {
        parent::__construct($managerRegistry, Page::class);
    }

    public function findPageById(PageId $id): ?Page
    {
        $query = $this->getQuery(<<<DQL
            SELECT page
            FROM {$this->getClassName()} page
            WHERE page.id = :id
        DQL);

        $query->setParameters(new ArrayCollection([
            new Parameter('id', $id),
        ]));

        return $query->getOneOrNullResult();
    }
}
