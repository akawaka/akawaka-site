<?php

declare(strict_types=1);

namespace App\CMS\Infrastructure\Persistence\ORM\Article;

use Doctrine\Persistence\ManagerRegistry;
use Mono\Component\Article\Domain\Entity\CategoryInterface;
use Mono\Component\Article\Domain\Identifier\CategoryId;
use Mono\Component\Article\Domain\Repository;
use Mono\Component\Core\Infrastructure\Persistence\Doctrine\ORMRepository;

final class CreateCategory extends ORMRepository implements Repository\CreateCategory
{
    public function __construct(ManagerRegistry $managerRegistry)
    {
        parent::__construct($managerRegistry, CategoryInterface::class);
    }

    public function insert(CategoryInterface $article): void
    {
        $this->manager->persist($article);
        $this->manager->flush();
    }

    public function nextIdentity(): CategoryId
    {
        return new CategoryId();
    }
}