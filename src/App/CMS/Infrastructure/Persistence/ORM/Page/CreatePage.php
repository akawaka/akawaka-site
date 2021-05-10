<?php

declare(strict_types=1);

namespace App\CMS\Infrastructure\Persistence\ORM\Page;

use Doctrine\Persistence\ManagerRegistry;
use Mono\Component\Core\Infrastructure\Persistence\Doctrine\ORMRepository;
use Mono\Component\Page\Domain\Entity\PageInterface;
use Mono\Component\Page\Domain\Identifier\PageId;
use Mono\Component\Page\Domain\Repository;

final class CreatePage extends ORMRepository implements Repository\CreatePage
{
    public function __construct(ManagerRegistry $managerRegistry)
    {
        parent::__construct($managerRegistry, PageInterface::class);
    }

    public function insert(PageInterface $page): void
    {
        $this->manager->persist($page);
        $this->manager->flush();
    }

    public function nextIdentity(): PageId
    {
        return new PageId();
    }
}
