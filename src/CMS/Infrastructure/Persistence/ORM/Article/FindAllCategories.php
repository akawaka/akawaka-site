<?php

declare(strict_types=1);

namespace App\CMS\Infrastructure\Persistence\ORM\Article;

use App\CMS\Domain\Entity\Category;
use Mono\Component\Article\Domain\Repository;
use Mono\Component\Core\Infrastructure\Persistence\Doctrine\DoctrineRepository;
use Doctrine\Persistence\ManagerRegistry;

final class FindAllCategories extends DoctrineRepository implements Repository\FindAllCategories
{
    public function __construct(ManagerRegistry $managerRegistry)
    {
        parent::__construct($managerRegistry, Category::class);
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
