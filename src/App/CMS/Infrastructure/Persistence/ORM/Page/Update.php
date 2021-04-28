<?php

declare(strict_types=1);

namespace App\CMS\Infrastructure\Persistence\ORM\Page;

use App\CMS\Domain\Entity\Page;
use Doctrine\Persistence\ManagerRegistry;
use Mono\Component\Core\Infrastructure\Persistence\Doctrine\DoctrineRepository;
use Mono\Component\Page\Domain\Entity\PageInterface;
use Mono\Component\Page\Domain\Repository;

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
