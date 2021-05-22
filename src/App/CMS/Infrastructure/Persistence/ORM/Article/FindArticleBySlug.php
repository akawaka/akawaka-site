<?php

declare(strict_types=1);

namespace App\CMS\Infrastructure\Persistence\ORM\Article;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Query\Parameter;
use Doctrine\Persistence\ManagerRegistry;
use Mono\Component\Article\Domain\Entity\ArticleInterface;
use Mono\Component\Article\Domain\Repository;
use Mono\Component\Article\Domain\ValueObject\Slug;
use Mono\Component\Core\Infrastructure\Persistence\Doctrine\ORMRepository;

final class FindArticleBySlug extends ORMRepository implements Repository\FindArticleBySlug
{
    public function __construct(ManagerRegistry $managerRegistry)
    {
        parent::__construct($managerRegistry, ArticleInterface::class);
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
