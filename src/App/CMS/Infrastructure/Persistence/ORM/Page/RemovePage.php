<?php

declare(strict_types=1);

namespace App\CMS\Infrastructure\Persistence\ORM\Page;

use Doctrine\Persistence\ManagerRegistry;
use Mono\Component\Core\Infrastructure\Persistence\Doctrine\ORMRepository;
use Mono\Component\Page\Domain\Entity\PageInterface;
use Mono\Component\Page\Domain\Repository;

final class RemovePage extends ORMRepository implements Repository\RemovePage
{
    public function __construct(ManagerRegistry $managerRegistry)
    {
        parent::__construct($managerRegistry, PageInterface::class);
    }

    public function remove(PageInterface $page): void
    {
        $this->manager->remove($page);
        $this->manager->flush();
    }
}
