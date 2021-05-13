<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\CMS\Infrastructure\Persistence\ORM\Article;

use Doctrine\Persistence\ManagerRegistry;
use Mono\Component\Article\Domain\Entity\ArticleInterface;
use Mono\Component\Article\Domain\Identifier\ArticleId;
use Mono\Component\Article\Domain\Repository;
use Mono\Component\Core\Infrastructure\Persistence\Doctrine\ORMRepository;

final class CreateArticle extends ORMRepository implements Repository\CreateArticle
{
    public function __construct(ManagerRegistry $managerRegistry)
    {
        parent::__construct($managerRegistry, ArticleInterface::class);
    }

    public function insert(ArticleInterface $article): void
    {
        $this->manager->persist($article);
        $this->manager->flush();
    }

    public function nextIdentity(): ArticleId
    {
        return new ArticleId();
    }
}
