<?php

declare(strict_types=1);

namespace App\CMS\Infrastructure\Persistence\ORM\Article;

use App\CMS\Domain\Entity\Category;
use Doctrine\Persistence\ManagerRegistry;
use Mono\Component\Article\Domain\Entity\CategoryInterface;
use Mono\Component\Article\Domain\Repository;
use Mono\Component\Core\Infrastructure\Persistence\Doctrine\DoctrineRepository;

final class RemoveCategory extends DoctrineRepository implements Repository\RemoveCategory
{
    public function __construct(ManagerRegistry $managerRegistry)
    {
        parent::__construct($managerRegistry, Category::class);
    }

    public function remove(CategoryInterface $category): void
    {
        $this->manager->remove($category);
        $this->manager->flush();
    }
}
