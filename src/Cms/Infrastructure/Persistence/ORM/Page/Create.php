<?php

declare(strict_types=1);

namespace App\Cms\Infrastructure\Persistence\ORM\Page;

use App\Cms\Domain\Entity\Page;
use Black\Component\Page\Domain\Entity\PageInterface;
use Black\Component\Page\Domain\Identifier\PageId;
use Black\Component\Core\Infrastructure\Persistence\Doctrine\DoctrineRepository;
use Black\Component\Page\Domain\Repository;
use Doctrine\Persistence\ManagerRegistry;

final class Create extends DoctrineRepository implements Repository\Create
{
    public function __construct(ManagerRegistry $managerRegistry)
    {
        parent::__construct($managerRegistry, Page::class);
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
