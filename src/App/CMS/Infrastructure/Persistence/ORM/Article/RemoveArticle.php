<?php

declare(strict_types=1);

namespace App\CMS\Infrastructure\Persistence\ORM\Article;

use App\CMS\Domain\Entity\Article;
use Doctrine\Persistence\ManagerRegistry;
use Mono\Component\Article\Domain\Entity\ArticleInterface;
use Mono\Component\Article\Domain\Repository;
use Mono\Component\Core\Infrastructure\Persistence\Doctrine\DoctrineRepository;

final class RemoveArticle extends DoctrineRepository implements Repository\RemoveArticle
{
    public function __construct(ManagerRegistry $managerRegistry)
    {
        parent::__construct($managerRegistry, Article::class);
    }

    public function remove(ArticleInterface $article): void
    {
        $this->manager->remove($article);
        $this->manager->flush();
    }
}
