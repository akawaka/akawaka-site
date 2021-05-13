<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\CMS\Infrastructure\Persistence\ORM\Page;

use Doctrine\Persistence\ManagerRegistry;
use Mono\Component\Core\Infrastructure\Persistence\Doctrine\ORMRepository;
use Mono\Component\Page\Domain\Entity\PageInterface;
use Mono\Component\Page\Domain\Repository;

final class UpdatePage extends ORMRepository implements Repository\UpdatePage
{
    public function __construct(ManagerRegistry $managerRegistry)
    {
        parent::__construct($managerRegistry, PageInterface::class);
    }

    public function update(PageInterface $page): void
    {
        $this->manager->flush();
    }
}
