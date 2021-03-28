<?php

declare(strict_types=1);

namespace App\Cms\Infrastructure\Persistence\ORM\Page;

use App\Cms\Domain\Entity\Page;
use Black\Component\Page\Domain\Entity\PageInterface;
use Black\Component\Core\Infrastructure\Persistence\Doctrine\DoctrineRepository;
use Black\Component\Page\Domain\Repository;
use Doctrine\Persistence\ManagerRegistry;

final class Update extends DoctrineRepository implements Repository\Update
{
    public function __construct(ManagerRegistry $managerRegistry)
    {
        parent::__construct($managerRegistry, Page::class);
    }

    public function update(PageInterface $page): void
    {
        $this->manager->flush();
    }
}
