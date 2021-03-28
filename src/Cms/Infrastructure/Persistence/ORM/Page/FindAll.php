<?php

declare(strict_types=1);

namespace App\Cms\Infrastructure\Persistence\ORM\Page;

use App\Cms\Domain\Entity\Page;
use Black\Component\Core\Infrastructure\Persistence\Doctrine\DoctrineRepository;
use Black\Component\Page\Domain\Repository;
use Doctrine\Persistence\ManagerRegistry;

final class FindAll extends DoctrineRepository implements Repository\FindAll
{
    public function __construct(ManagerRegistry $managerRegistry)
    {
        parent::__construct($managerRegistry, Page::class);
    }

    public function findAll(): array
    {
        $query = $this->getQuery(<<<SQL
            SELECT page
            FROM {$this->getClassName()} page
        SQL);

        return $query->execute();
    }
}
