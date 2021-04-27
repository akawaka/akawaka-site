<?php

declare(strict_types=1);

namespace App\CMS\Infrastructure\Persistence\ORM\Article;

use App\CMS\Domain\Entity\Article;
use Mono\Component\Article\Domain\Repository;
use Mono\Component\Core\Infrastructure\Persistence\Doctrine\DoctrineRepository;
use Doctrine\Persistence\ManagerRegistry;

final class FindAllArticles extends DoctrineRepository implements Repository\FindAllArticles
{
    public function __construct(ManagerRegistry $managerRegistry)
    {
        parent::__construct($managerRegistry, Article::class);
    }

    public function findAll(): array
    {
        $query = $this->getQuery(<<<SQL
            SELECT article
            FROM {$this->getClassName()} article
        SQL);

        return $query->execute();
    }
}
