<?php

declare(strict_types=1);

namespace Black\Bundle\PeanutBundle\Application\Page\Repository;

use Black\Bundle\PeanutBundle\Domain\Entity\Page\Page;
use Black\Bundle\PeanutBundle\Domain\Repository\FindPageBySlugRepository;
use Black\Bundle\CoreBundle\Infrastructure\Persistence\Doctrine\DoctrineRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\Query\Parameter;

final class FindPageBySlugORM extends DoctrineRepository implements FindPageBySlugRepository
{
    public function __construct(ManagerRegistry $managerRegistry)
    {
        parent::__construct($managerRegistry, Page::class);
    }

    public function findPageBySlug(string $slug): ?Page
    {
        $query = $this->getQuery(<<<DQL
            SELECT page
            FROM {$this->getClassName()} page
            WHERE page.slug = :slug
        DQL);

        $query->setParameters(new ArrayCollection([
            new Parameter('slug', $slug),
        ]));

        return $query->getOneOrNullResult();
    }
}
