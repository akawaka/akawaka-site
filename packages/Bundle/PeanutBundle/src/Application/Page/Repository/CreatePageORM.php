<?php

declare(strict_types=1);

namespace Black\Bundle\PeanutBundle\Application\Page\Repository;

use Black\Bundle\PeanutBundle\Domain\Entity\Page\Page;
use Black\Bundle\PeanutBundle\Domain\Repository\CreatePageRepository;
use Black\Bundle\CoreBundle\Infrastructure\Persistence\Doctrine\DoctrineRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

final class CreatePageORM extends DoctrineRepository implements CreatePageRepository
{
    public function __construct(ManagerRegistry $managerRegistry)
    {
        parent::__construct($managerRegistry, Page::class);
    }

    public function save(Page $page): void
    {
        $this->manager->persist($page);
        $this->manager->flush();
    }
}
