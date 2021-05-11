<?php

declare(strict_types=1);

namespace App\CMS\Infrastructure\Persistence\ORM\Article;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Query\Parameter;
use Doctrine\Persistence\ManagerRegistry;
use Mono\Component\Article\Domain\Entity\CategoryInterface;
use Mono\Component\Article\Domain\Repository;
use Mono\Component\Article\Domain\ValueObject\Slug;
use Mono\Component\Core\Infrastructure\Persistence\Doctrine\ORMRepository;

final class FindCategoryBySlug extends ORMRepository implements Repository\FindCategoryBySlug
{
    public function __construct(ManagerRegistry $managerRegistry)
    {
        parent::__construct($managerRegistry, CategoryInterface::class);
    }

    public function find(Slug $slug): CategoryInterface
    {
        $query = $this->getQuery(<<<SQL
                SELECT category
                FROM {$this->getClassName()} category
                WHERE category.slug = :slug
            SQL);

        $query->setParameters(new ArrayCollection([
            new Parameter('slug', $slug->getValue()),
        ]));

        return $query->getSingleResult();
    }
}