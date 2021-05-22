<?php

declare(strict_types=1);

namespace App\CMS\Infrastructure\Persistence\ORM\Article;

use Doctrine\Persistence\ManagerRegistry;
use Mono\Component\Article\Domain\Entity\CategoryInterface;
use Mono\Component\Article\Domain\Repository;
use Mono\Component\Core\Infrastructure\Persistence\Doctrine\ORMRepository;

final class FindAllCategories extends ORMRepository implements Repository\FindAllCategories
{
    public function __construct(ManagerRegistry $managerRegistry)
    {
        parent::__construct($managerRegistry, CategoryInterface::class);
    }

    public function findAll(): array
    {
        $query = $this->getQuery(<<<SQL
                SELECT category
                FROM {$this->getClassName()} category
            SQL);

        return $query->execute();
    }
}
