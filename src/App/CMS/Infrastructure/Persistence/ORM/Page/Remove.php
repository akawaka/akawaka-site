<?php

declare(strict_types=1);

namespace App\CMS\Infrastructure\Persistence\ORM\Page;

use App\CMS\Domain\Entity\Page;
use Doctrine\Persistence\ManagerRegistry;
use Mono\Component\Core\Infrastructure\Persistence\Doctrine\DoctrineRepository;
use Mono\Component\Page\Domain\Entity\PageInterface;
use Mono\Component\Page\Domain\Repository;

final class Remove extends DoctrineRepository implements Repository\Remove
{
    public function __construct(ManagerRegistry $managerRegistry)
    {
        parent::__construct($managerRegistry, Page::class);
    }

    public function remove(PageInterface $page): void
    {
        $this->manager->remove($page);
        $this->manager->flush();
    }
}
