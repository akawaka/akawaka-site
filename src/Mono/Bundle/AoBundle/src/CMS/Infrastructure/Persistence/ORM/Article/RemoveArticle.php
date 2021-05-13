<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\CMS\Infrastructure\Persistence\ORM\Article;

use Doctrine\Persistence\ManagerRegistry;
use Mono\Component\Article\Domain\Entity\ArticleInterface;
use Mono\Component\Article\Domain\Repository;
use Mono\Component\Core\Infrastructure\Persistence\Doctrine\ORMRepository;

final class RemoveArticle extends ORMRepository implements Repository\RemoveArticle
{
    public function __construct(ManagerRegistry $managerRegistry)
    {
        parent::__construct($managerRegistry, ArticleInterface::class);
    }

    public function remove(ArticleInterface $article): void
    {
        $this->manager->remove($article);
        $this->manager->flush();
    }
}
