<?php

declare(strict_types=1);

namespace App\CMS\Infrastructure\Persistence\ORM\Article;

use App\CMS\Domain\Entity\Article;
use Mono\Component\Article\Domain\Entity\ArticleInterface;
use Mono\Component\Article\Domain\Repository;
use Mono\Component\Article\Domain\ValueObject\Slug;
use Mono\Component\Core\Infrastructure\Persistence\Doctrine\DoctrineRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Query\Parameter;
use Doctrine\Persistence\ManagerRegistry;

final class FindArticleBySlug extends DoctrineRepository implements Repository\FindArticleBySlug
{
    public function __construct(ManagerRegistry $managerRegistry)
    {
        parent::__construct($managerRegistry, Article::class);
    }

    public function find(Slug $slug): ArticleInterface
    {
        $query = $this->getQuery(<<<SQL
            SELECT article
            FROM {$this->getClassName()} article
            WHERE article.slug = :slug
        SQL);

        $query->setParameters(new ArrayCollection([
            new Parameter('slug', $slug->getValue()),
        ]));

        return $query->getSingleResult();
    }
}
