<?php

declare(strict_types=1);

namespace Mono\Bundle\AoBundle\CMS\Infrastructure\Persistence\ORM\Article;

use Doctrine\Persistence\ManagerRegistry;
use Mono\Component\Article\Domain\Entity\CategoryInterface;
use Mono\Component\Article\Domain\Repository;
use Mono\Component\Core\Infrastructure\Persistence\Doctrine\ORMRepository;

final class UpdateCategory extends ORMRepository implements Repository\UpdateCategory
{
    public function __construct(ManagerRegistry $managerRegistry)
    {
        parent::__construct($managerRegistry, CategoryInterface::class);
    }

    public function update(CategoryInterface $category): void
    {
        $this->manager->flush();
    }
}
