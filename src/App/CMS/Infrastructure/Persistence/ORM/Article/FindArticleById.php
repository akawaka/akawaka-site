<?php

declare(strict_types=1);

namespace App\CMS\Infrastructure\Persistence\ORM\Article;

use App\CMS\Domain\Entity\Article;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Query\Parameter;
use Doctrine\Persistence\ManagerRegistry;
use Mono\Component\Article\Domain\Entity\ArticleInterface;
use Mono\Component\Article\Domain\Identifier\ArticleId;
use Mono\Component\Article\Domain\Repository;
use Mono\Component\Core\Infrastructure\Persistence\Doctrine\DoctrineRepository;

final class FindArticleById extends DoctrineRepository implements Repository\FindArticleById
{
    public function __construct(ManagerRegistry $managerRegistry)
    {
        parent::__construct($managerRegistry, Article::class);
    }

    public function find(ArticleId $id): ArticleInterface
    {
        $query = $this->getQuery(<<<SQL
                SELECT article
                FROM {$this->getClassName()} article
                WHERE article.id = :id
            SQL);

        $query->setParameters(new ArrayCollection([
            new Parameter('id', $id->getValue()),
        ]));

        return $query->getSingleResult();
    }
}
