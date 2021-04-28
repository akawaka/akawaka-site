<?php

declare(strict_types=1);

namespace App\CMS\Infrastructure\Persistence\ORM\Page;

use App\CMS\Domain\Entity\Page;
use Doctrine\Persistence\ManagerRegistry;
use Mono\Component\Core\Infrastructure\Persistence\Doctrine\DoctrineRepository;
use Mono\Component\Page\Domain\Repository;

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
