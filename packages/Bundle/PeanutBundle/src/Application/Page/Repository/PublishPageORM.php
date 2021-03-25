<?php

declare(strict_types=1);

namespace Black\Bundle\PeanutBundle\Application\Page\Repository;

use Black\Bundle\PeanutBundle\Domain\Entity\Page\Page;
use Black\Bundle\PeanutBundle\Domain\Repository\PublishPageRepository;
use Black\Bundle\CoreBundle\Infrastructure\Persistence\Doctrine\DoctrineRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

final class PublishPageORM extends DoctrineRepository implements PublishPageRepository
{
    public function __construct(ManagerRegistry $managerRegistry)
    {
        parent::__construct($managerRegistry, Page::class);
    }

    public function save(Page $page): void
    {
        $this->manager->flush();
    }
}
